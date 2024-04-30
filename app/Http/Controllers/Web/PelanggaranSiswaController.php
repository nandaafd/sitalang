<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\MasterPelanggaran;
use App\Models\PelanggaranSiswa;
use App\Models\Sanksi;
use App\Models\Siswa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PelanggaranSiswaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $kat = $request->kategori_id;
            $pel = $request->pelanggaran_id;
            $kategori = Kategori::where('is_deleted',false)->get();
            $pelanggaran = MasterPelanggaran::where('is_deleted',false)->get();
            $query = PelanggaranSiswa::with('siswa','user', 'pelanggaran')
                ->where('is_deleted', false)
                ->where('pelanggaran_id','LIKE', '%'.$pel.'%')
                ->whereHas('siswa.user', function ($query) use ($nama) {
                    $query->where('fullname', 'LIKE', '%'.$nama.'%');
                })
                ->whereHas('pelanggaran', function ($query) use ($kat) {
                    $query->where('kategori_id', 'LIKE', '%'.$kat.'%');
                })
                ->orderBy('tanggal', 'desc');
            

            if ($request->semua) {
                $pelsis = $query->paginate(10);
            }
            elseif ($request->this_year) {
                $oneYearAgo = Carbon::now()->subYear();
                $query->where('tanggal', '>=', $oneYearAgo);
            }
            elseif ($request->this_month) {
                $startDate = Carbon::now()->startOfMonth();
                $query->where('tanggal', '>=', $startDate);
            }   
            elseif ($request->other === 'Bulan lalu') {
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            } 
            elseif ($request->other === 'Minggu ini') {
                $startDate = Carbon::now()->startOfWeek(); 
                $endDate = Carbon::now()->endOfWeek();
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }
            elseif ($request->other === 'Tahun lalu') {
                $startDate = Carbon::now()->subYear()->startOfYear(); 
                $endDate = Carbon::now()->subYear()->endOfYear();
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }
            else {
                $pelsis = $query->paginate(10);
            }

            $pelsis = $query->paginate(10);

            if ($pelsis->isEmpty()) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            $pelsis = new LengthAwarePaginator([], 0, 10);
        }
        if (Auth::user()->role->name == 'guru') {
            return view('web.pelanggaran-siswa.index', compact('pelsis','kategori','kat','pelanggaran','pel','nama'));
        }
        else {
            return view('web.pelanggaran-siswa.indexsiswa', compact('pelsis','kategori','kat','pelanggaran','pel','nama'));
        }
        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $siswa = Siswa::with('user')->where('is_deleted',false)->get();
            $pelanggaran = MasterPelanggaran::where('is_deleted',false)->get();
            $sanksi = Sanksi::where('is_deleted',false)->get();
            if ($siswa->count() == 0 || $pelanggaran->count() == 0 || $sanksi->count() == 0) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaran-siswa.index')->with('err','gagal menambah, data tidak dapat ditemukan');
        }
        return view('web.pelanggaran-siswa.create',compact('siswa','pelanggaran','sanksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id'=>'required',
                'siswa_id'=>'required',
                'pelanggaran_id'=> 'required',
                'tanggal'=> 'required',
                'sanksi_id'=> 'required',
            ]);
            if (!$validator->fails()) {
                PelanggaranSiswa::create($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaran-siswa.index')->with('err','gagal menambah data, internal server error');
        }
        return redirect()->route('pelanggaran-siswa.index')->with('success','berhasil menambahkan data pelanggaran siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pelsis = PelanggaranSiswa::with('siswa.user','siswa.kelas','user','pelanggaran.kategori')
            ->where('is_deleted',false)->find($id);
           
            if ($pelsis->count() == 0) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaran-siswa.index')->with('err','gagal melihat detail pelanggaran, terjadi kesalahan pada data');
        }
        // return $pelsis;
        return view('web.pelanggaran-siswa.show',compact('pelsis'));
    }

  
    public function edit($id)
    {
        try {
            $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
            ->where('is_deleted',false)->find($id);
            $siswa = Siswa::with('user')->where('is_deleted',false)->get();
            $pelanggaran = MasterPelanggaran::where('is_deleted',false)->get();
            $sanksi = Sanksi::where('is_deleted',false)->get();
            if ($siswa->count() == 0 || $pelanggaran->count() == 0 || $sanksi->count() == 0) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaran-siswa.index')->with('err','gagal menambah, data tidak dapat ditemukan');
        }
        return view('web.pelanggaran-siswa.edit',compact('siswa','pelanggaran','sanksi','pelsis'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id'=>'required',
                'siswa_id'=>'required',
                'pelanggaran_id'=> 'required',
                'tanggal'=> 'required',
                'sanksi_id'=> 'required',
            ]);
            if (!$validator->fails()) {
                PelanggaranSiswa::find($id)->update($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaran-siswa.index')->with('err','gagal edit data, internal server error');
        }
        return redirect()->route('pelanggaran-siswa.index')->with('success','berhasil mengedit data pelanggaran siswa');
    }

    public function destroy($id)
    {
        try {
            PelanggaranSiswa::find($id)->update(['is_deleted'=>true]);
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('pelanggaran-siswa.index')->with('success','berhasil menghapus data');
    }
}
