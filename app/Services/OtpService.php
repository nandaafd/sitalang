<?php
namespace App\Services;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FA\Google2FA;

class OtpService
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function generateOtp($email)
    {
        // Generate OTP
        $otp = $this->google2fa->generateSecretKey();

        // Save OTP to database (if needed)

        // Send OTP via email
        Mail::to($email)->send(new OtpMail($otp));

        return $otp;
    }
}
