<?php
namespace App\Services\Constructors;

use App\Models\User;

interface OtpConstructor
{
    public static function generateOtp();

    public static function verifyOtp(User $user, $otp);
}
