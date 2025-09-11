<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // If the route starts with /admin, send to admin login
            if ($request->is('admin/*')) {
                return redirect()->route('admin.login');
            }

            // Otherwise send to normal login
            return redirect()->route('loginPage');
        }

        return $next($request);
    }
}
