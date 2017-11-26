<?php
	/**
	* 
	*/
	require_once __DIR__ . "/../Model/Model.php";
	class Controller
	{
		protected $m;
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
	}
?>