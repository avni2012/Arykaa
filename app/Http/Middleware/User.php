<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // user roles is 2
        if (auth()->user() &&  auth()->user()->status == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
