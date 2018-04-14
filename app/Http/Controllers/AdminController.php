<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:29
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-24 20:20:41
 */
namespace App\Http\Controllers;

use App\App;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
	protected $data = [];
	public function index()
	{
		return redirect()->route('admin.dashboard.index');
	}
	/* Apps */
	public function apps()
	{
		$this->data['apps'] = App::all();
		return view('admin.apps', $this->data);
	}

	public function test()
	{
		$data['user'] = Auth::user();
		return view('x', $data);
	}
}
