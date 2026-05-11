<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminFilter
{
    public function handle($request, Closure $next)
    {
        // Check if the user is an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login'); // Redirect if not authorized
        }

        return $next($request); // Proceed if authorized
    }
}