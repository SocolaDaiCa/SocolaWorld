<?php 
	session_start();
	require_once __DIR__ . '/Comtroller/Controller_User.php';
	$cUser = new Controller_User();
	$cUser->logout();
?>