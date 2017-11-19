<?php
	session_start();
	require_once '../../Controller/Controller_User.php';
	$cUser = new Controller_User;
	$cUser->checkLogin();
?>