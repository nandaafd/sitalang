<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $filkelas = $request->kelas_id;
            $kelas = Kelas::where('is_deleted',false)->get();
            $siswa = Siswa::with("user")->where('is_deleted',false)->where('kelas_id','LIKE', '%'.$filkelas.'%')->whereHas('user', function ($query) use ($nama) {
                $query->where('fullname', 'LIKE', '%'.$nama.'%');
            })->paginate(10);
        } catch (Exception $ex) {
            $siswa = new LengthAwarePaginator([], 0, 10);
            // session()->flash('err', $ex->getMessage());
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        return view('web.siswa.index',compact('siswa','nama','filkelas','kelas'));
    }
    public function create()
    {
        try{
            $kelas = Kelas::where('is_deleted',false)->get();
            if (!$kelas) {
                throw new Exception("Gagal tersambung dengan database", 1);
            }
        }
        catch(Exception $ex){
            return back()->with('err',$ex->getMessage());
        }
        return view('web.siswa.create',compact('kelas'));
    }
    public function store(Request $request)
    {
        try {
            $role = Role::where('name','siswa')->first();
            if ($role) {
                if ($request->password === $request->confirm_password) {
                    $validator = Validator::make($request->all(),[
                        'fullname'=>'required',
                        'nickname'=>'required',
                        'jenis_kelamin'=>'required',
                        'kelas_id'=>'required',
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
                        $siswa = Siswa::create([
                            'user_id'=>$user->id,
                            'kelas_id'=>$request->kelas_id,
                            'no_telp'=>$request->no_telp,
                            'alamat'=>$request->alamat,
                            'jenis_kelamin'=>$request->jenis_kelamin,
                            'tempat_lahir'=>$request->tempat_lahir,
                            'tanggal_lahir'=>$request->tanggal_lahir,
                            'nama_ortu'=>$request->nama_ortu,
                            'telp_ortu'=>$request->telp_ortu,
                            'is_deleted'=>false
                        ]);
                        $token = Token::where('email',$request->email)->latest()->update([
                            'is_expired'=>true,
                            'updated_at'=>Date::now(),
                            'is_deleted'=>false
                        ]);
                    }
                    else {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }
                else {
                    throw new Exception("Gagal membuat akun, password tidak sama", 1);
                }
            }
            else{
                throw new Exception("data role guru tidak dapat ditemukan", 1);
            }
        } catch (Exception $ex) {
            return redirect()->route('data-siswa.index')->with('err',$ex->getMessage());
        }
        return redirect()->route('data-siswa.index')->with('success','Berhasil menambah data siswa '. $siswa->user->fullname);
    }

    public function show(string $id)
    {
        try {
            $data = Siswa::find($id);
            if (!$data) {
                throw new Exception("gagal mendapatkan data siswa", 1);
            }
        } catch (Exception $ex) {
            $data =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('web.siswa.index', compact('data'));
        }
        return view('web.siswa.show', compact('data'));
    }


}
