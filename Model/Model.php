<?php
	require_once __DIR__ . '/config.php';
	class Database
	{
		private $host;
		private $username;
		private $password;
		private $database;
		protected $conn;
		function __construct()
		{
			if(!empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'facebook.dev:8888'){
				$this->host = 'localhost';
				$this->username = 'root';
				$this->password = '';
				$this->database = 'socola_world';
			} else {
				$this->host = 'localhost';
				$this->username = 'dangdung_admin';
				$this->password = '1bnBZYww';
				$this->database = 'dangdung_socolaworld';
			}
			$this->conn = new MySQLi(
				$this->host,
				$this->username,
				$this->password,
				$this->database
			);
			if ($this->conn->connect_error) {
				die("ERROR : -> ".$this->conn->connect_error);
			}
			mysqli_set_charset($this->conn,"utf8");
		}
		public function getStmt($stmt)
		{
			$data = [];
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc())
				$data[] = $row;
			return json_decode(json_encode($data));
		}
		public function query($sql)
		{
			$data = [];
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc())
				$data[] = $row;
			return json_decode(json_encode($data));
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