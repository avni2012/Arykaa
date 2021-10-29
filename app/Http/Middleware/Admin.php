<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Zizaco\Entrust\HasRole;
use Illuminate\Http\Request;

class Admin
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
        if(auth()->check() && count(auth()->user()->roles()->get())){
            return $next($request);
        }
        return redirect('/control-panel/login');
    }
}
