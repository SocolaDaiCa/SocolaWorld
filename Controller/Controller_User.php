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