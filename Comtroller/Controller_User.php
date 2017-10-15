<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../lib/Socola-graph-fb.php';
	class Controller_User extends Controller
	{
		function __construct()
		{
			
		}
		public function checkLogin()
		{
			// print_r($_SESSION);
			// exit();
			$login = $_SESSION["login"] ?? false;
			if($login){
				$_SESSION["login"] = true;
				return;
			}
			// echo("Aaaaaaaaaaaaa" . $_SESSION["login"]);
			$autoLogin = $_COOKIE['auto_login'] ?? false;
			$token = $_COOKIE['token'] ?? '';
			$graph = new SocolaGraphFacebook();
			if (!empty($token) && $autoLogin &&  $graph->isTokenLive($token)){
				return;
			}
			$_SESSION['u'] = $_SERVER["REQUEST_URI"];
			die(header('Location: /login.php'));
		}
		public function setCookie($userID, $username, $token, $autoLogin)
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
			header('Location: ./');
		}
	}
?>