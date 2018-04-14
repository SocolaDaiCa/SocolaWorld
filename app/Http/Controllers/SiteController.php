<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:30
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 06:14:47
 */
namespace App\Http\Controllers;
use App\Models\App;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socola\FacebookGraph;

class SiteController extends Controller
{
	public function index()
	{
		$data['categorys'] = $categorys = Category::with([
			'apps' => function($q){
				$q->where('show', 1);
			}
		])->get();
		return view('site.pages.index', $data);
	}
	public function getLogin()
	{
		return view('site.pages.login');
	}
	public function login(Request $request)
	{
		
		$username = $request['username'];
		$password = $request['password'] ?? '';
		$token    = $request['token'];
		// echo($token);
		$code     = $request['code'];
		$ok = false;
		if(!empty($username) && !empty($password)){
			$token = FacebookGraph::getToken($username, $password)->access_token;
		}

		$fb = new FacebookGraph($token);
		$info = $fb->graph('me', ['fields' => 'id, name, email']);
		
		if(empty($info->id)){
			return 'lỗi';
		}

		$user = User::firstOrNew(['user_id' => $info->id]);
		$user->email = $info->email;
		$user->name = $info->name;
		$user->token = $token;
		$user->password = bcrypt('');
		$user->avatar = "https://graph.facebook.com/{$user->user_id}/picture?type=large&redirect=true&width=40&height=40";
		$user->save();
		$data = ['user_id' => $user->user_id, 'password' => ''];
		if(Auth::attempt($data))
			return redirect()->route('site.index');
	}
	public function loginFacebook()
	{
		$clientID = '425249171186475';
		$redirectURI = route('site.facebook.callback');
		$url = FacebookGraph::login($clientID, $redirectURI);
		return redirect($url);
	}

	public function facebookCallback(Request $request)
	{
		$code = $request['code'];
		$clientID = '425249171186475';
		$redirectURI = route('site.facebook.callback');
		$token = FacebookGraph::codeToToken($code, $clientID, $redirectURI, '1723fe0ec79cd0cf142c93b9010ff5d8');
		$fb = new FacebookGraph($token);
		$info = $fb->graph('me', ['fields' => 'id, name, email']);

		$user = User::firstOrNew(['user_id' => $info->id]);
		$user->email = $info->email;
		$user->name = $info->name;
		$user->token = $token;
		$user->password = bcrypt('');
		$user->save();
		$data = ['user_id' => $user->user_id, 'password' => ''];
		if(Auth::attempt($data))
			return redirect()->route('site.index');
	}
	public function logout()
	{
		Auth::logout();
		return redirect()->route('site.index');
	}
}
