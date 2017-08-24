<?php
	session_start();
	require 'lib/function.php';
	$action = empty($_GET['action']) ? '' : $_GET['action'];
	switch ($action) {
		case 'loginWithFacebook':
			loginWithFacebook();
			break;
		case 'getToken':
			echo($_COOKIE['token']);
			break;
		default:
			echo('không có gì xảy ra');
			break;
	}
?>