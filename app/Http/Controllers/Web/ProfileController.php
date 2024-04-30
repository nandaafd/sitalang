<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::where('user_id',$id)->get();
        $siswa = Siswa::where('user_id',$id)->get();
        return view('Web.profile.index',compact('siswa','guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
                $guru = Guru::where('user_id',$id)->get();
                $siswa = Siswa::where('id',$id)->get();
                $kelas = Kelas::all();
        } catch (Exception $ex) {
            return redirect()->back()->with('err','anda belum login, silahkan login terlebih dahulu');
        }
        return view('web.profile.edit',compact('siswa','guru','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
