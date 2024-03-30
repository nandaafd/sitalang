<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function IndexFromDashboard($id) {
        $data = User::where('id',$id)->first();
        return view("dashboard.profile.change-password",compact('data'));
    }
    public function Index() {
        return view("dashboard.profile.change-password");
    }
    public function Update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->DB::update(['password' => bcrypt($request->password)]);

            return redirect('login')->with('success', 'Password changed successfully!');
        } else {
            return back()->withErrors(['current_password' => 'Incorrect current password.']);
        }
    }
    public function UpdateFromDashboard(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('id',$id)->first();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => bcrypt($request->password)]);

            return redirect()->back()->with('success', 'Berhasil mengganti password '.$user->fullname);
        } else {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }
    }
}
