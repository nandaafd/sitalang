<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sanksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class SanksiController extends Controller
{

    public function index(Request $request)
    {
        try {
            $filter = $request->filter;
            $sanksi = Sanksi::where('is_deleted',false)->
            where('sanksi','like','%'.$filter.'%')->paginate(10);
        } catch (Exception $ex) {
            $sanksi = new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        return view('dashboard.sanksi.index', compact('sanksi','filter'));
    }

    public function create()
    {
        return view('dashboard.sanksi.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'range_poin'=> 'required',
                'sanksi' => 'required'
            ]);
            if (!$validator->fails()) {
                Sanksi::create($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('sanksi.index')->with('err','gagal menambah data, internal server error');
        }
        return redirect()->route('sanksi.index')->with('success','Berhasil menambah data sanksi');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $data = Sanksi::where('is_deleted',false)->find($id);
            if ($data == null) {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch (Exception $ex) {
            $sanksi = new LengthAwarePaginator([], 0, 10);
            return redirect('/dashboard/sanksi')->with('err',$ex->getMessage());
        }
        return view('dashboard.sanksi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'range_poin'=> 'required',
                'sanksi' => 'required'
            ]);
            if (!$validator->fails()) {
                Sanksi::find($id)->update($request->all());
            }
            else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('sanksi.index')->with('err','gagal mengedit data, internal server error');
        }
        return redirect()->route('sanksi.index')->with('success','berhasil mengedit data sanksi');
    }

    public function destroy($id)
    {
        try {
            $data = Sanksi::find($id)->update([
                'is_deleted'=> true
            ]);
            if ($data == null) {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch (Exception $ex) {
            return redirect('/dashboard/sanksi')->with('err',$ex->getMessage());
        }
        return redirect()->route('sanksi.index')->with('success','berhasil menghapus data sanksi');
    }
}
