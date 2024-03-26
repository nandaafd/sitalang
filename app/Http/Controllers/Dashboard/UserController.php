<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function block(Request $request){
        try {
            if ($request->has('is_blocked')) {
                $isBlocked = true;
                $string = 'memblokir';
            }
            else {
                $isBlocked = false;
                $string = 'membuka blokir';
            }
            $user = User::where('id',$request->user_id)->first();
            $user->update(['is_blocked' => $isBlocked]);
        } catch (\Exception $e) {
            return redirect()->back()->with('err','gagal memblokir data '.$e->getMessage());
        }
        return redirect()->back()->with('success','berhasil '. $string . ' '. $user->fullname);
    }
    
}
