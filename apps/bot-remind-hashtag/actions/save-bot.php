<?php 
	require_once '../../../db/connect.php';
	if (empty($_POST['group']) || empty($_COOKIE['userid'])) {
		return;
	}
	// print_r($_POST['group']);
	echo $db->saveBot($_COOKIE['userid'], $_POST['group'], $_POST['token']);
?>