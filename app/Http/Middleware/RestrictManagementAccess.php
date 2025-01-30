<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictManagementAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->name !== 'دينالي' || $user->email !== 'deenali@admin.com' || $user->account_type !== 'مشتري') {
            abort(403, 'ليس لديك الصلاحية للوصول إلى هذه الصفحة.');
        }

        return $next($request);
    }
}
