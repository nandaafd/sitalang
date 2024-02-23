<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{

    public function index(Request $request)
    {
        try{
            $jurusan = $request->jurusan;
            $kls = $request->kelas;
            if ($jurusan || $kls) {
                $kelas = Kelas::where('is_deleted',false)->where('name','like','%'.$kls.'%')
                ->where('name','like','%'.$jurusan.'%')->paginate(10);
            }
            else {
                $kelas =  Kelas::where('is_deleted',false)->paginate(10);
            }
        }
        catch (Exception $e) {
            $kelas =  new LengthAwarePaginator([], 0, 10);;
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        
        return view('Dashboard.Kelas.index', compact('kelas','jurusan','kls'));
    }

    public function create()
    {
        return view('Dashboard.Kelas.create');
    }

    public function store(Request $request)
    {
        try {
           $validator = Validator::make($request->all(), [
                'name'=> 'required',
            ]);
            if (!$validator->fails()) {
                $kelas = new Kelas;
                $kelas->name = $request->name;
                $kelas->is_deleted = false;
                $kelas->save();
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect('/dashboard/kelas')->with('success','Berhasil menambahkan data kelas');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $data = Kelas::find($id);
        } catch (Exception $ex) {
            $kelas =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('dashboard.kelas.edit', compact('data'));
        }
        return view('dashboard.kelas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'=> 'required',
            ]);
            if (! $validator->fails()) {
                Kelas::where('id',$id)->update([
                    'name'=>$request->name
                ]);
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('kelas.index')->with('success','berhasil mengedit data kelas');
    }

    public function destroy(string $id)
    {
        try{

            if ($id != null || $id != 0) {
                Kelas::where('id',$id)->update([
                    'is_deleted'=>true
                ]);
            }
            else {
                return redirect()->back()->withErrors('data tidak ditemukan');
            }
        }
        catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('kelas.index')->with('success','berhasil menghapus data kelas');
    }
}
