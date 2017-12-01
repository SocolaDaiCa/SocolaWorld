<?php
	require_once __DIR__ . '/Model.php';
	/**
	* 
	*/
	class Model_Girl extends Database
	{
		function __construct()
		{
			parent::__construct();
		}
		public function addImage($target, $src)
		{
			$sql = "insert into girls (target, src) value ('$target', '$src')";
			$this->run($sql);
		}
		public function getImages()
		{
			return $this->query("select src from girls");
			return $this->query("select src from girls limit 0, 10");
		}
	}
?>