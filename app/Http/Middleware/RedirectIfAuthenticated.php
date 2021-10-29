<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            if (!$request->is('control-panel/logout') && Auth::guard($guard)->check()) {
                return redirect('/control-panel/dashboard');
            }
        }
        if ($guard == "users" && Auth::guard($guard)->check()) {
            // return redirect('/home');
            return redirect('/');
        }
        return $next($request);
    }
}
