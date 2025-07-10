<?php

// app/Http/Middleware/CheckIfSuspended.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfSuspended
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_suspended) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been suspended due to suspicious activity. Please contact the admin.'
            ]);
        }

        return $next($request);
    }
}
