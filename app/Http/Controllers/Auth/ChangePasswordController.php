<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetPassword;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function IndexFromDashboard($id) {
        $data = User::where('id',$id)->first();
        return view("dashboard.profile.change-password",compact('data'));
    }
    public function IndexFromWeb($id) {
        $data = User::where('id',$id)->first();
        return view("web.profile.change-password",compact('data'));
    }
    public function Index() {
        return view("dashboard.profile.change-password");
    }
    
    public function Update(Request $request, $id)
    {
        try {
            $string = "";
            $validator = Validator::make($request->all(),[
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);
            
            if (!$validator->fails()) {
                if (Auth::user()->role->name == "admin") {
                    $user = User::where('id',$id)->first();
                    $string = "change password by admin";
                }
                else{
                    $user = User::where('id',Auth::id())->first();
                    $string = "change password by self";
                }
                $passwordCollection = ResetPassword::where('email',$user->email)->get();
                foreach ($passwordCollection as $key => $value) {
                    if (Hash::check($request->password, $value->old_password) || Hash::check($request->password, $value->new_password)) {
                        throw new Exception("anda pernah menggunakan password yang sama, silahkan cari password baru", 1);
                    }
                }
                if ($user) {
                    if (!Hash::check($request->password, $user->password)) {
                        if (Hash::check($request->current_password, $user->password)) {
                            $user->update(['password' => bcrypt($request->password)]);
                            $resetPassword = new ResetPassword;
                            $resetPassword->email = $user->email;
                            $resetPassword->old_password = bcrypt($request->current_password);
                            $resetPassword->new_password = bcrypt($request->password);
                            $resetPassword->used_for = $string;
                            $resetPassword->save();
                        } else {
                            throw new Exception("Password lama salah");
                        }
                    }
                    else{
                        throw new Exception("Password baru anda sama dengan password saat ini");
                    }
                }
                else{
                    throw new Exception("data user tidak bisa ditemukan");
                }
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('err', 'gagal ganti password, '.$ex->getMessage());
        }
        
        return redirect()->back()->with('success', 'Berhasil mengganti password '.$user->fullname);
        
    }
}
