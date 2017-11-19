<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	class Controller_Admin extends Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		public function getListUsers()
		{
			$sql = "select * from user";
			return $this->query($sql);
		}
		public function getTotalUsers()
		{
			$data = $this->query("select count(*) as `count` from user");
			return $data[0]->count;
		}
	}
?>