<?php
	/**
	* 
	*/
	require_once __DIR__ . "/../Model/Model.php";
	class Controller
	{
		private $m;
		function __construct()
		{
			$this->m = new Database();
		}
		public function query($sql)
		{
			return $this->m->query($sql);
		}
		public function run($sql)
		{
			return $this->m->run($sql);
		}
		public function isLogin()
		{
			return $_SESSION['login'] ?? FALSE;
		}
		public function checkLogin()
		{
			if($_SESSION["login"] ?? '')
				return;
			$token = $_COOKIE['token'] ?? '';
			$graph = new GraphFacebook();
			if (!empty($token) &&  $graph->isTokenLive($token)){
				return;
			}
			$_SESSION['u'] = $_SERVER["REQUEST_URI"];
			die(header('Location: /login.php'));
		}
		public function getInfo()
		{
			[
				'userid' => $id,
				'username' => $name
			] = $_COOKIE;
			return array(
				'id' => $id,
				'name' => $name,
				'avartar' => "https://graph.facebook.com/{$id}/picture?type=large&redirect=true&width=40&height=40"
			);
		}
	}
?>