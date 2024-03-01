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
        $user = User::all();
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role->name === 'admin') {
                return redirect('/dashboard');
            }else {
                return redirect()->intended('/home');
            }
            
        }
        
        return back()->with('loginError', 'Login Failed.');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }
}
