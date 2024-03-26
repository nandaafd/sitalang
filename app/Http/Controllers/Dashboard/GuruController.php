<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
   
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $guru = Guru::with("user")->where('is_deleted',false)->whereHas('user', function ($query) use ($nama) {
                $query->where('fullname', 'LIKE', '%'.$nama.'%');
            })->paginate(10);
        } catch (Exception $ex) {
            $guru = new LengthAwarePaginator([], 0, 10);
            // session()->flash('err', $ex->getMessage());
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        return view('dashboard.guru.index',compact('guru','nama'));
    }

    public function create()
    {
        return view('dashboard.guru.create');
    }

    public function store(Request $request)
    {
        try {
            $role = Role::where('name','guru')->first();
            if ($role) {
                $validator = Validator::make($request->all(),[
                    'fullname'=>'required',
                    'nickname'=>'required',
                    'nip'=>'required',
                    'alamat'=>'required',
                    'no_telp'=>'required',
                    'email'=>'required',
                    'password'=>'required',
                    'confirm_password'=>'required'
                ]);
                if (!$validator->fails()) {
                    $user = User::create([
                        'fullname'=>$request->fullname,
                        'nickname'=>$request->nickname,
                        'email'=>$request->email,
                        'password'=>bcrypt($request->password),
                        'role_id'=>$role->id,
                    ]);
                    $guru = Guru::create([
                        'user_id'=>$user->id,
                        'nip'=>$request->nip,
                        'alamat'=>$request->alamat,
                        'no_telp'=>$request->no_telp,
                    ]);
                }
                else {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            else{
                throw new Exception("data role guru tidak dapat ditemukan", 1);
            }
        } catch (Exception $ex) {
            return redirect()->route('guru.index')->with('err',$ex->getMessage());
        }
        return redirect()->route('guru.index')->with('success','Berhasil menambah data guru '. $guru->user->fullname);
    }

    public function show(string $id)
    {
        try {
            $data = Guru::find($id);
            if (!$data) {
                throw new Exception("gagal mendapatkan data guru", 1);
            }
        } catch (Exception $ex) {
            $data =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('dashboard.guru.index', compact('data'));
        }
        return view('dashboard.guru.show', compact('data'));
    }

    public function edit(string $id)
    {
        try {
            $data = Guru::find($id);
            if (!$data) {
                throw new Exception("gagal mendapatkan data guru", 1);
            }
        } catch (Exception $ex) {
            $data =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('dashboard.guru.index', compact('data'));
        }
        return view('dashboard.guru.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $guru = Guru::where('id',$id)->first();
            $validator = Validator::make($request->all(),[
                'fullname'=>'required',
                'nickname'=>'required',
                'nip'=>'required',
                'alamat'=>'required',
                'no_telp'=>'required'
            ]);
            if (!$validator->fails()) {
                $guru->update([
                    'nip'=>$request->nip,
                    'alamat'=>$request->alamat,
                    'no_telp'=>$request->no_telp
                ]);
                $user = User::where('id',$guru->user_id)->update([
                    'fullname'=>$request->fullname,
                    'nickname'=>$request->nickname
                ]);
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('guru.index')->with('err','Gagal mengedit data, internal server error');
        }
        return redirect()->route('guru.index')->with('success','Berhasil mengedit data guru '.$guru->user->fullname);
    }

    public function destroy(string $id)
    {
        try {
            $guru = Guru::findOrFail($id);
            if ($guru) {
                $guru->delete();
                $user = User::where('id',$guru->user_id)->delete();
            }
            else{
                throw new Exception("gagal mendapatkan data guru", 1);
                
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('err','Gagal menghapus data '.$ex->getMessage());
        }
        return redirect('/dashboard/guru')->with('success','Berhasil menghapus data');
    }
}
