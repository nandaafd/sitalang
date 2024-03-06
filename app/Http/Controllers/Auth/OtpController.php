<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OtpService;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp()
    {
        $email = 'wilbert.feil@ethereal.email'; // Ganti dengan email penerima OTP
        $otp = $this->otpService->generateOtp($email);
        return $otp;
        return "OTP telah dikirim ke $email";
    }
}
