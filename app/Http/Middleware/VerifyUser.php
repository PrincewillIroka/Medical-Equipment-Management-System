<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyUser
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
        if(!Auth::guard('web')->check()) {
            return redirect(url('login'));
        }
        return $next($request);
    }
}
