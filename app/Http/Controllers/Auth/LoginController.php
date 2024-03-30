<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::User()) {
            if ($user->role_id === '1') {
                return redirect()->intended('/dashboard');
            }else{
                return redirect()->intended('/');
            }
        }else {
            return view('auth.login');
            
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $users = User::where('email',$request->email)->first();
        if ($users) {
            if ($users->is_blocked == true) {
                return back()->with('loginError', 'Akun anda terblokir, silahkan hubungi admin untuk membuka blokir.');
            }
            else{
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    User::where('id',Auth::id())->update([
                        'last_login' => now(),
                        'login_attempt' => 0
                    ]);
                    if (Auth::user()->role->name === 'admin') {
                        return redirect('/dashboard');
                    } else {
                        return redirect()->intended('/home');
                    }
                } else {
                    $user = User::where('email', $request->email)->first();
        
                    if ($user) {
                        if ($user->login_attempt < 5) {
                            $user->update(['login_attempt' => $user->login_attempt + 1]);
                        } else {
                            $user->update(['is_blocked' => true]);
                        }
                    }
                    return back()->with('loginError', 'Login gagal. email atau password salah!');
                }
            }
        }
        else{
            return back()->with('loginError', 'Login gagal. email atau password salah!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }
}
