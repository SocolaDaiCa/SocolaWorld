<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\App;

class AppsController extends Controller
{
	protected $data = [];
	function __construct()
	{
		$this->middleware(function ($request, $next) {
			$category = [];
			$listCategorys = Category::all();
			foreach ($listCategorys as $category) {
				$categorys[] = [
					'name' => $category->name,
					'apps' => App::where('category', $category->tag)->where('show', true)->get()
				];
			}
			$categorys = json_decode(json_encode($categorys));
			$this->data['categorys'] = $categorys;
			$this->data['user'] = Auth::user() ?? null;
			return $next($request);
		});
	}
    public function index()
    {
    	return redirect()->route('site.index');
    }
    public function getToken()
    {
    	return Auth::user()->token;
    }
    public function cookieToToken()
    {
    	return view('apps.cookie-to-token', $this->data);
    }
}
