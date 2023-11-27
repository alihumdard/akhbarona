<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomCKFinderAuth
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
        if(Auth::check()) {
            config(['ckfinder.authentication' => function() {
                return true;
            }]);
        } else {
            config(['ckfinder.authentication' => function() {
                return false;
            }]);
        }
        return $next($request);
    }
}
