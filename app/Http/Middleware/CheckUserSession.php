<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $userId = session('user_id');
        if (!$userId || !Cache::has('user_session_' . $userId)) {
            // Not logged in!
            return redirect('/login');
        }
        // Optionally attach cached user data to request
        $request->merge(['userData' => Cache::get('user_session_' . $userId)]);
        return $next($request);
    }
}
