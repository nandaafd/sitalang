<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('auth.forgotpassword.forgotpassword');
    }
    public function resetPassword($idParam){
        $id = $idParam;
        return view('auth.forgotpassword.resetpassword',compact('id'));
    }
    public function sendMail(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                "email"=>"required",
            ]);
            if (!$validator->fails()) {
                $user = User::where('email',$request->email)->first();
                if ($user) {
                    $route = route('resetPassword',$user->id);
                    Mail::to($request->email)->send(new ForgotPasswordMail($route));
                }
                else{
                    return redirect()->back()->with('err','email belum terdaftar atau pastikan email anda benar');
                }
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput(); 
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('err','gagal mengirim email '.$ex->getMessage());
        }
        
        return redirect()->back()->with('success','email reset password berhasil terkirim');
    }
    public function process(Request $request, $id){
        try{
            $validator = Validator::make($request->all(),[
                'password_confirmation' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);
            if (!$validator->fails()) {
                $user = User::where('id',$id)->first();
                if (!Hash::check($request->password, $user->password)) {
                    $string = "forgot password";
                    $passwordCollection = ResetPassword::where('email',$user->email)->get();
                    foreach ($passwordCollection as $key => $value) {
                        if (Hash::check($request->password, $value->old_password) || Hash::check($request->password, $value->new_password)) {
                            throw new Exception("anda pernah menggunakan password yang sama, silahkan cari password baru", 1);
                        }
                    }
                    if ($user) {
                        $user->update(['password' => bcrypt($request->password)]);
                        $resetPassword = new ResetPassword;
                        $resetPassword->email = $user->email;
                        $resetPassword->old_password = $user->password;
                        $resetPassword->new_password = bcrypt($request->password);
                        $resetPassword->used_for = $string;
                        $resetPassword->save();
                    }
                    else{
                        throw new Exception("data user tidak bisa ditemukan");
                    }
                }
                else{
                    throw new Exception("password baru anda sama dengan password anda saat ini");
                }
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        catch(Exception $ex){
            return redirect()->back()->with('err', 'gagal reset password, '.$ex->getMessage());
        }
        
        return redirect()->route('login')->with('success','berhasil reset password, silahkan login dengan password baru anda');
    }
}
