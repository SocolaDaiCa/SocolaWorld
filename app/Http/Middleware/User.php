<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-05-14 16:27:04
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 16:34:14
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        if(!Auth::check() || Auth::user()->permission_id == 3){
            return redirect()->route('site.login');
        }
        return $next($request);
    }
}
