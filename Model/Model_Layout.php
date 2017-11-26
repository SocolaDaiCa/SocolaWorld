<?php 
	/**
	* 
	*/
	require_once __DIR__ . '/Model.php';
	class Model_Layout extends Database
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function getApps($category = "")
		{
			$sql = "select * from apps";
			if(!empty($category))
				$sql .= " where category = '$category'";
			return $this->query($sql);
		}
		public function getCategory()
		{
			return $this->query("select * from category");
		}
	}
?>