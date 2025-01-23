<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAccountTypeIsBuyer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->account_type === 'مشتري') {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
