<?php 
	require_once '../../../db/connect.php';
	if(empty($_COOKIE['userid'])){
		return;
	}
	echo($db->getListBots($_COOKIE['userid']));
?>