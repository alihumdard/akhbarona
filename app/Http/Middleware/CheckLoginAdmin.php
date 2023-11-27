<?php
/**
 * Created by dinhbang19@gmail.com.
 * Date: 9/21/2017
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
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
        $currentRequest = $request->getPathInfo();
        $prefix = 'admincpanel';
        if (Auth::guard('admin')->check() === false && $currentRequest !== '/'.$prefix.'/login' &&  strpos($currentRequest, '/'.$prefix.'/password/remind') === false &&  strpos($request->getPathInfo(), '/'.$prefix.'/password/reset') === false) {

            return redirect(route('adminLogin'));
        }
        return $next($request);
    }
}
