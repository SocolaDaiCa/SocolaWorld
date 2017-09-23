<?php
	require_once '../../../db/connect.php';
	// header('Content-Type: application/json');
	// $_POST['userId'] = '100004399725901';
	// $_POST['groupId'] =  '1977663915583096';
	if(empty($_COOKIE['userid']) || empty($_POST['groupId'])){
		echo 'rỗng';
		return;
	}
	if(empty($_POST['hashtag'])){
		echo $db->getHashTag($_COOKIE['userid'], $_POST['groupId']);
		// echo 'get xong';
	} else {
		$db->saveHashTag($_COOKIE['userid'], $_POST['groupId'], $_POST['hashtag']);
		echo 'set xong';
	}

?>