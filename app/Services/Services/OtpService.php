<?php
namespace App\Services\Services;

use App\Mail\SendOtpMail;
use App\Models\User;
use App\Services\Constructors\OtpConstructor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpService implements OtpConstructor
{
    public static function generateOtp()
    {
        $user = Auth::user();
        $otp = rand(100000, 999999);
        $user->update([
            'is_active_user' => true,
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));
    }

    public static function verifyOtp(User $user, $otp)
    {
        return $user->otp === $otp && Carbon::now()->lt($user->otp_expires_at);
    }
}
