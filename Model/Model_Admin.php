<?php 
	/**
	* 
	*/
	require_once __DIR__ . '/Database.php';
	class Model_Admin extends Database
	{
		function __construct()
		{
			parent::__construct();
		}
		public function getInfoAdmin()
		{
			return array(
				'name' => $_COOKIE['username'],
				'avatar' => $_COOKIE['username'],
				'' => '',
				'' => '',
			);
		}
		public function getTotalUsers()
		{
			$sql = "Select count(user_id) from user";
			return $this->query($sql)[0][0];
		}
	}
?>