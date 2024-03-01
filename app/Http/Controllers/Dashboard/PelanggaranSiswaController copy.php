<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MasterPelanggaran;
use App\Models\PelanggaranSiswa;
use App\Models\Sanksi;
use App\Models\Siswa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class PelanggaranSiswaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pelanggaran = $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
            ->where('is_deleted',false)->orderBy('tanggal','desc')->paginate(10);
            if ($request->semua) {
                $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
                ->where('is_deleted',false)->orderBy('tanggal','desc')->paginate(10);
                if ($pelsis->isEmpty()) {
                    throw new Exception();
                }
            }
            elseif ($request->this_year) {
                $oneYearAgo = Carbon::now()->subYear();
                $pelsis = PelanggaranSiswa::with('user', 'pelanggaran')
                    ->where('is_deleted', false)
                    ->where('tanggal', '>=', $oneYearAgo)
                    ->orderBy('tanggal','desc')->paginate(10);
            }
            elseif ($request->this_month) {
                $startDate = Carbon::now()->startOfMonth();
                $pelsis = PelanggaranSiswa::with('user', 'pelanggaran')
                ->where('is_deleted', false)
                ->where('tanggal', '>=', $startDate)
                ->orderBy('tanggal','desc')->paginate(10);
            }   
            elseif ($request->other === 'Bulan lalu') {
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();

                $pelsis = PelanggaranSiswa::with('user', 'pelanggaran')
                ->where('is_deleted', false)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal','desc')->paginate(10);
            } 
            elseif ($request->other === 'Minggu ini') {
                $startDate = Carbon::now()->startOfWeek(); 
                $endDate = Carbon::now()->endOfWeek();

                $pelsis = PelanggaranSiswa::with('user', 'pelanggaran')
                ->where('is_deleted', false)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal','desc')->paginate(10);
            }
            elseif ($request->other === 'Tahun lalu') {
                $startDate = Carbon::now()->subYear()->startOfYear(); 
                $endDate = Carbon::now()->subYear()->endOfYear();

                $pelsis = PelanggaranSiswa::with('user', 'pelanggaran')
                ->where('is_deleted', false)
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal','desc')->paginate(10);
            }
            else {
                $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
                ->where('is_deleted',false)->orderBy('tanggal','desc')->paginate(10);
            }
            if ($pelsis->isEmpty()) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            $pelsis = new LengthAwarePaginator([], 0, 10);
        }
        return view('dashboard.pelanggaran-siswa.index', compact('pelsis'));
        
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
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal menambah, data tidak dapat ditemukan');
        }
        return view('dashboard.pelanggaran-siswa.create',compact('siswa','pelanggaran','sanksi'));
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
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal menambah data, internal server error');
        }
        return redirect()->route('pelanggaransiswa.index')->with('success','berhasil menambahkan data pelanggaran siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
            ->where('is_deleted',false)->where('id',$id)->get();
           
            if ($pelsis->count() == 0) {
                throw new Exception();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal melihat data, terjadi kesalahan pada data');
        }
        return view('dashboard.pelanggaran-siswa.show',compact('pelsis'));
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
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal menambah, data tidak dapat ditemukan');
        }
        return view('dashboard.pelanggaran-siswa.edit',compact('siswa','pelanggaran','sanksi','pelsis'));
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
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal edit data, internal server error');
        }
        return redirect()->route('pelanggaransiswa.index')->with('success','berhasil mengedit data pelanggaran siswa');
    }

    public function destroy($id)
    {
        try {
            PelanggaranSiswa::find($id)->update(['is_deleted'=>true]);
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('pelanggaransiswa.index')->with('success','berhasil menghapus data');
    }
}
