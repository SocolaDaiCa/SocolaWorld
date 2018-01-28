<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Liblary\Graph;
use App\User;
use App\App;
use App\Category;

class SiteController extends Controller
{
	protected $data = [];
	function __construct()
	{
		
	}
	public function index()
	{
		$this->data['user'] = Auth::user();

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
		return view('site.pages.index', $this->data);
	}
	public function login(Request $request)
	{
		
		$username = $request['username'];
		$password = $request['password'] ?? '';
		$token    = $request['token'];
		$code     = $request['code'];
		$ok = false;
		if(!empty($code)){
			$token = Graph::codeToToken($code);
		}
		if(!empty($username) && !empty($password)){
			$token = Graph::getToken($username, $password)->access_token;
		}
		$fb = new Graph($token);
		$info = $fb->graph('me', ['fields' => 'id, name, email']);
		if(!empty($info->id)){
			return $info;
		}
		print_r($info);
		return '';
		$user = User::firstOrNew(['user_id' => $info->id]);
		$user->email = $info->email;
		$user->name = $info->name;
		$user->token = $token;
		$user->password = bcrypt($password);
		$user->save();
		$data = ['user_id' => $user->user_id, 'password' => $password];
		if(Auth::attempt($data))
			return redirect()->route('site.index');
	}
	public function logout()
	{
		Auth::logout();
		return redirect()->route('site.index');
	}
}
