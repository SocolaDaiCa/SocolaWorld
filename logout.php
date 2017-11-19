<?php 
	session_start();
	require_once __DIR__ . '/Controller/Controller_User.php';
	$cUser = new Controller_User();
	$cUser->logout();
?>