<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('auth.register',compact('kelas'));
    }
}
