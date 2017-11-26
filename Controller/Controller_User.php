<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	class Controller_User extends Controller
	{
		private $timeLive = 60*60*24*60; /*60 ngày*/
		function __construct()
		{
			parent::__construct();
			// die(print_r($_SESSION));
		}
		public function isLogin()
		{
			return $_SESSION['login'] ?? FALSE;
		}
		public function checkLogin()
		{
			if($_SESSION["login"] ?? FALSE)
				return;
			// exit();
			$token = $_COOKIE['token'] ?? '';
			$graph = new GraphFacebook();
			if (!empty($token) &&  $graph->isTokenLive($token)){
				$_SESSION["login"] = TRUE;
				$data = $graph->getInfoUser();
				$userID = $data['id'];
				$username = $data['name'];
				$this->setSession($userID, $username, $token, true);
				return;
			}
			$_SESSION['u'] = $_SERVER["REQUEST_URI"];
			die(header('Location: /login.php'));
		}
		public function getInfo()
		{
			$id = $_COOKIE['userid'];
			$name = $_COOKIE['username'];
			return array(
				'id' => $id,
				'name' => $name,
				'avartar' => "https://graph.facebook.com/{$id}/picture?type=large&redirect=true&width=40&height=40"
			);
		}
		public function setCookie($name, $value)
		{
			setcookie($name, $value, time() + $this->timeLive);
		}
		public function removeCookie($name)
		{
			setcookie($name, $value, time() + $this->timeLive);
		}
		public function setSession($userID, $username, $token)
		{
			$_SESSION["username"] = $username;
			$_SESSION["userid"]   = $userID;
			$_SESSION["token"]    = $token;
		}
		public function login()
		{
			
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