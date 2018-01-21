<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\App;

class AdminController extends Controller
{
	protected $data = [];
	function __construct()
	{
		$this->middleware(function ($request, $next) {
			$user = Auth::user();
			$avatar = "https://graph.facebook.com/{$user->user_id}/picture?type=large&redirect=true&width=40&height=40";
			$this->data['name'] = $user->name;
			$this->data['avatar'] = $avatar;
			return $next($request);
		}); 
	}
	public function index()
	{
		return redirect()->route('admin.dashboard');
	}
	public function dashboard()
	{
		$a = User::all()->count();
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		$c = User::where('created_at', '>=', $lastWeek)->count();
		$this->data['totalUsers'] = $a;
		$this->data['percentUserNew'] = $a ? (100.0 * $c / ($a - $c)) : '?';
		return view('admin.dashboard', $this->data);
	}
	public function users()
	{
		$this->data['users'] = User::all();
		return view('admin.users', $this->data);
	}
	/* Apps */
	public function apps()
	{
		$this->data['apps'] = App::all();
		return view('admin.apps', $this->data);
	}
}
