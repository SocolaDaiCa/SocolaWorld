<?php 
	require_once '../../../db/connect.php';
	if(empty($_COOKIE['userid']) || empty($_POST['groupID'])){
		return;
	}
	echo $db->getBot($_COOKIE['userid'], $_POST['groupID']);
?>