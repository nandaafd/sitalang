<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\MasterPelanggaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class MasterPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $kat = $request->kategori_id;
            $kategori = Kategori::where('is_deleted',false)->get();
            $pelanggaran = MasterPelanggaran::with('kategori')->where('is_deleted',false)->
            where('nama_pelanggaran','like','%'.$nama.'%')->where('kategori_id','like','%'.$kat.'%')->paginate(10);
        } catch (Exception $ex) {
            $pelanggaran = new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        return view('dashboard.master-pelanggaran.index', compact('pelanggaran','nama','kat','kategori'));
    }
    public function create()
    {
        try{
            $kategori = Kategori::where('is_deleted',false)->get();
            if($kategori == null){
                throw new Exception("Data kategori tidak dapat ditemukan", 1);
            }
        }
        catch (Exception $ex) {
            session()->flash('err', $ex->getMessage());
            return redirect()->route('masterpelanggaran.index');
        }
        return view('dashboard.master-pelanggaran.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_pelanggaran'=> 'required',
                'poin'=>'required',
                'kategori_id'=>'required',
            ]);
            if (!$validator->fails()) {
                MasterPelanggaran::create($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('masterpelanggaran.index')->with('err','gagal menambah data, internal server error');
        }
        return redirect()->route('masterpelanggaran.index')->with('success','berhasil menambah data master pelanggaran');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        try{
            $kategori = Kategori::where('is_deleted',false)->get();
            $pelanggaran = MasterPelanggaran::where('is_deleted',false)->find($id);
            if($pelanggaran == null){
                throw new Exception("Data tidak dapat ditemukan", 1);
            }
        }
        catch (Exception $ex) {
            session()->flash('err', $ex->getMessage());
            return redirect()->route('masterpelanggaran.index');
        }
        return view('dashboard.master-pelanggaran.edit', compact('kategori','pelanggaran'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_pelanggaran'=> 'required',
                'poin'=>'required',
                'kategori_id'=>'required',
            ]);
            if (!$validator->fails()) {
                MasterPelanggaran::find($id)->update($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('masterpelanggaran.index')->with('err','gagal edit data, internal server error');
        }
        return redirect()->route('masterpelanggaran.index')->with('success','berhasil mengedit data master pelanggaran');
    }

    public function destroy(string $id)
    {
        try {
            $data = MasterPelanggaran::find($id)->update([
                'is_deleted'=> true
            ]);
            if ($data == null) {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch (Exception $ex) {
            return redirect('/dashboard/masterpelanggaran')->with('err',$ex->getMessage());
        }
        return redirect()->route('masterpelanggaran.index')->with('success','berhasil menghapus data master pelanggaran');
    }
}
