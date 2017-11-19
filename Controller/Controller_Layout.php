<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	class Controller_Layout extends Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		public function getListApps(){
			$sql = "select * from apps";
			return $this->query($sql);
		}
		public function showBtnLogin()
		{
			if($this->isLogin()){
				return '
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$_SESSION['username'].' <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/logout.php">Đăng xuất</a></li>
					</ul>
				</li>';
			}
			return '<li><a href="/login.php">Đăng nhập</a></li>';
		}
	}
?>