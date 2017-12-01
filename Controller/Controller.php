<?php
	/**
	* 
	*/
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once __DIR__ . "/../Model/Model.php";
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
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