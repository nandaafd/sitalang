<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::where('is_deleted',false)->paginate(10);
        return view('Dashboard.Kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return redirect('/dashboard/kelas')->with('success','berhasil menambahkan data kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kelas::find($id);
        return view('dashboard.kelas.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
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
        }
        catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('kelas.index')->with('success','berhasil mengedit data kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
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
