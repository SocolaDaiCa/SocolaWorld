<?php
	define('hostName', 'localhost');
	define('username', 'root');
	define('password', '');
	define('databaseName', 'facebook');

	$conn = new MySQLi(hostName, username, password, databaseName);
	if ($conn->connect_errno) {
		die("ERROR : -> ".$conn->connect_error);
	}
?>