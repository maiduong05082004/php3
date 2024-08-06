<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('user')->check()) {
            return redirect('/login');
        }
        return $next($request);
    }
}

