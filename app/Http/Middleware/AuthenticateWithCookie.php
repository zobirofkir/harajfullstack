<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticateWithCookie
{
    public function handle(Request $request, Closure $next)
    {
        if ($token = Cookie::get('access_token')) {
            $passportToken = Token::where('id', $token)->first();

            if ($passportToken && !$passportToken->hasExpired()) {
                $user = $passportToken->user;
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
