<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if (Auth::user()->role->name == 'siswa') {
            $siswa_id = Siswa::where('user_id',$id)->first();
            $pelanggaran = PelanggaranSiswa::with('pelanggaran')->where('is_deleted',false)->where('siswa_id',$siswa_id->id)->get();
            $tot = [];
            foreach ($pelanggaran as $key => $value) {
                array_push($tot, $value->pelanggaran->poin);
            }
            $total_poin = array_sum($tot);
        }
        if (Auth::user()->role->name == 'siswa') {
            return view('Web.profile.index',compact('siswa','guru','total_poin'));
        }
        else{
            return view('Web.profile.index',compact('guru'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
                $guru = Guru::where('user_id',$id)->get();
                $siswa = Siswa::where('user_id',$id)->get();
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
        try {
            if ($request->has('guru_form')) {
                $old_image = $request->oldImage;
                $validatedData = $request->validate([
                    'nickname'=>'required',
                    'fullname'=>'required',
                    'nip'=>'required',
                    'no_telp'=>'required',
                    'foto'=>'image|file|max:2048'
                ]);
                if ($request->hasFile('foto')) {
                    if ($request->oldImage) {
                        Storage::delete($request->oldImage);
                    }
                    $path = $request->file('foto')->store('foto-profil');
                }else{
                    $path = $old_image;
                }
                User::where('id',$request->user_id)->update([
                    'fullname'=>$request->fullname,
                    'nickname'=>$request->nickname,
                ]);
                Guru::where('id',$id)->update([
                    'nip'=>$request->nip,
                    'alamat'=>$request->alamat,
                    'no_telp'=>$request->no_telp,
                    'foto'=>$path
                ]); 
            }elseif ($request->has('siswa_form')) {
                $old_image = $request->oldImage;
                $validatedData = $request->validate([
                'fullname'=>'required',
                'nickname'=>'required',
                'kelas_id'=>'required',
                'alamat'=>'required',
                'no_telp'=>'required',
                'foto'=>'image|file|max:2048'
                ]);
                if ($request->hasFile('foto')) {
                    if ($request->oldImage) {
                        Storage::delete($request->oldImage);
                    }
                    $path = $request->file('foto')->store('foto-profil');
                }else{
                    $path = $old_image;
                }
                User::where('id',$request->user_id)->update([
                    'fullname'=>$request->fullname,
                    'nickname'=>$request->nickname,
                ]);
                Siswa::where('id',$request->id)->update([
                    'alamat'=>$request->alamat,
                    'kelas_id'=>$request->kelas_id,
                    'no_telp'=>$request->no_telp,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tanggal_lahir'=>$request->tanggal_lahir,
                    'nama_ortu'=>$request->nama_ortu,
                    'telp_ortu'=>$request->telp_ortu,
                    'foto'=>$path
                ]);
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('err','gagal edit profile '.$ex);
        }
        return redirect()->route('profile.show',$request->user_id)->with('success','berhasil mengedit profile anda');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
