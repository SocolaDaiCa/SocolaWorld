<?php
	session_start();
	require __DIR__ . '/Comtroller/Controller_User.php';
	$cUser = new Controller_User();
	$cUser->checkLogin();
?>