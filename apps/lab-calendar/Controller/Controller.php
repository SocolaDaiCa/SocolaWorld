<?php
	/**
	* 
	*/
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	class Controller
	{
		function __construct()
		{
			
		}
		public function isLogin()
		{
			if(empty($_COOKIE['token']))
				return FALSE;
			if(!empty($_SESSION["login"]) && $_SESSION["login"])
				return TRUE;
			$graph = new GraphFacebook();
			if($graph->isTokenLive($_COOKIE['token'])){
				return TRUE;
			}
		}
		public function setCookie($userID, $username, $token, $autoLogin = 0)
		{
			$timeLive = 60*60*24*60; /*60 ngày*/
			setcookie('username',  $username, time() + $timeLive);
			setcookie('userid',  $userID, time() + $timeLive);
			setcookie('token', $token, time() + $timeLive);
			setcookie('auto_login',  $autoLogin, time() + $timeLive);
		}
		public function logout()
		{
			session_destroy();
			setcookie('token',  '', time() - 5184000);
			setcookie('userid',  '', time() - 5184000);
			setcookie('username',  '', time() - 5184000);
		}
		public function getInfo()
		{
			return json_decode(json_encode(array(
				'name' => $_COOKIE['username']
			)));
		}
	}
?>