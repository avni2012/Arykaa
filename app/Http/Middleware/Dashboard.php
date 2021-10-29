<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
// use App\Models\UserInterests;

class Dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (!Auth::guard('users')->check()) {
            return redirect('/');
        }
        return $next($request);
    }
}
