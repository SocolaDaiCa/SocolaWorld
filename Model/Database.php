<?php
	/**
	* 
	*/
	class Database
	{
		private $host;
		private $username;
		private $password;
		private $database;
		private $conn;
		function __construct()
		{
			if(!empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'facebook.dev:8080'){
				$this->host = 'localhost';
				$this->username = 'root';
				$this->password = '';
				$this->database = 'socola_world';
			} else {
				$this->host = 'localhost';
				$this->username = 'tentstud_socola_world';
				$this->password = 'ORRM6JpFL+ul';
				$this->database = 'tentstud_socola_world';
			}
			$this->conn = new MySQLi(
				$this->host,
				$this->username,
				$this->password,
				$this->database
			);
			if ($this->conn->connect_errno) {
				die("ERROR : -> ".$this->conn->connect_error);
			}
			mysqli_set_charset($this->conn,"utf8");
		}
		public function query($sql)
		{
			return $this->conn->query($sql)->fetch_all();
		}
		public function run($sql)
		{
			return $this->conn->query($sql);
		}
		function __destruct(){
			if($this->conn)
				$this->conn->close();
		}
	}
?>