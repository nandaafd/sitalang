<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Services\OtpService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isNull;

class OtpController extends Controller
{
    public function createOtp($email){
        try {
            $otp = rand(100000, 999999);
            $token = Token::create([
                'email'=>$email,
                'token'=> $otp,
                'expired_at'=> Date::now()->addMinutes(10),
                'is_expired'=> false,
                'used_for'=>'register',
                'is_deleted'=>false
            ]);
        } catch (Exception $ex) {
            return redirect('/register')->with('err', 'gagal membuat kode otp');
        }
        Mail::to($token->email)->send(new OtpMail($otp));
        return response()->json(['success' => true, 'message' => 'Email verification code sent successfully']);
    }
    public function verifyOtp($otp, $email){
        $token = Token::where('email',$email)->latest()->first();
        if ($token != null) {
            if (Date::now() > $token->expired_at) {
                $token->is_expired = true;
                $token->save();
                return response()->json(['success' => false, 'message' => 'Kode OTP sudah kadaluarsa, silahkan kirim ulang!']);
            }
            else {
                if ($otp == $token->token && $token->is_expired == false) {
                    $token->is_expired = true;
                    $token->save();
                }
                else {
                    return response()->json(['success' => false, 'message' => 'Verifikasi gagal, kode OTP anda salah!']);
                }
            }
        }
        else {
            return response()->json(['success' => false, 'message' => 'Server Error']);
        }
        return response()->json(['success' => true, 'message' => 'Verifikasi kode OTP berhasil']);
    }
}
