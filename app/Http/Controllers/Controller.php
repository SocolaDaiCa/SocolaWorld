<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:29
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 06:15:14
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	function __construct()
	{
		$this->middleware(function ($request, $next) {
			if(Auth::check()){
				$user = Auth::user();
				
				View::share('user', $user);
			}
			
			return $next($request);
		});
	}
}
