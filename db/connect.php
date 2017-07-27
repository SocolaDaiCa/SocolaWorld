<?php
	require_once __DIR__ . '/config.php';
	$conn = new MySQLi(hostName, username, password, databaseName);
	if ($conn->connect_errno) {
		die("ERROR : -> ".$conn->connect_error);
	}
?>