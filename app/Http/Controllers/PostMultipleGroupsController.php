<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostMultipleGroupsController extends Controller
{
	protected $data = [];
	protected $x;
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			$this->data['user']= Auth::user();
			return $next($request);
		});
	}
	public function index()
	{
		return view('apps.pages.post-multiple-groups', $this->data);
	}
}
