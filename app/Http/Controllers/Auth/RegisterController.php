<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('auth.register',compact('kelas'));
    }
    
    public function store(Request $request){
        try {
            if ($request->password == $request->confirm_password) {
                if ($request->has('guru')) {
                    $user = User::create([
                        'fullname'=>$request->fullname,
                        'nickname'=>$request->nickname,
                        'email'=>$request->email,
                        'password'=> bcrypt($request->password),
                        'role_id'=> 2, //id role guru
                        'is_deleted'=>false
                    ]);
                    $guru = Guru::create([
                        'user_id'=> $user->id,
                        'nip'=>$request->nip,
                        'alamat'=>$request->alamat,
                        'no_telp'=>$request->no_telp,
                        'is_deleted'=>false
                    ]);
                }
                elseif ($request->has('siswa')) {
                    $user = User::create([
                        'fullname'=>$request->fullname,
                        'nickname'=>$request->nickname,
                        'email'=>$request->email,
                        'password'=> bcrypt($request->password),
                        'role_id'=> 3, //id role siswa
                        'is_deleted'=>false
                    ]);
                    $siswa = Siswa::create([
                        'user_id'=>$user->id,
                        'kelas_id'=>$request->kelas_id,
                        'no_telp'=>$request->no_telp,
                        'alamat'=>$request->alamat,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'tempat_lahir'=>$request->tempal_lahir,
                        'tanggal_lahir'=>$request->tanggal_lahir,
                        'nama_ortu'=>$request->nama_ortu,
                        'telp_ortu'=>$request->telp_ortu,
                        'is_deleted'=>false
                    ]);
                }
                $token = Token::where('email',$request->email)->latest()->update([
                    'is_expired'=>true,
                    'updated_at'=>Date::now(),
                    'is_deleted'=>false
                ]);
            }
            else {
                throw new Exception('password tidak sama');
            }
            
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                return redirect()->back()->with('err', 'gagal mendaftar, email anda sudah terdaftar');
            } else {
                return redirect()->back()->with('err','gagal mendaftar '. $ex->getMessage());
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('err','gagal mendaftar '. $ex->getMessage());
        }
        
        return redirect('/login')->with('success','berhasil mendaftarkan akun silahkan login');
    }
}
