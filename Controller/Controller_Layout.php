<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller_User.php';
	require_once __DIR__ . '/../Model/Model_Layout.php';
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	class Controller_Layout extends Controller_User
	{
		protected $m;
		function __construct()
		{
			parent::__construct();
			$this->m = new Model_Layout;
		}
		public function getApps($category = ""){
			return $this->m->getApps($category);
		}
		public function getCategory()
		{
			return $this->m->getCategory();
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