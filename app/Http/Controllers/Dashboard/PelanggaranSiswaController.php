<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MasterPelanggaran;
use App\Models\PelanggaranSiswa;
use App\Models\Sanksi;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class PelanggaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pelsis = PelanggaranSiswa::with('user')->with('pelanggaran')
            ->where('is_deleted',false)->paginate(10);
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
        return view('dashboard.pelanggaran-siswa.show',compact('siswa','pelanggaran','sanksi'));
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
