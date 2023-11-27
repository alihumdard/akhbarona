<?php
/**
 * Created by dinhbang19@gmail.com.
 * Date: 03/31/2019
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        /*$user = Auth::guard('web')->user();
        if(!$user || !isset($user->id)) {
            return redirect(route('front.login'));
        }*/
        return $next($request);
    }
}
