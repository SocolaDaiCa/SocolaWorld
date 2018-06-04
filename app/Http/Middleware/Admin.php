<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-05-14 16:32:43
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 16:36:20
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::user()->permission_id != 2){
            return redirect()->route('site.login');
        }
        return $next($request);
    }
}
