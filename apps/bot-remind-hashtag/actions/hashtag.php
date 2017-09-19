<?php 
	require_once '../../../db/connect.php';
	if(!empty($_POST['hashtag'])){
		$db->saveHashTag($_POST['hashtag'])
		
	}
	if(!empty($_POST['userId']) && !empty($_POST['groupId'])){
		$db->getHashTag($_POST['groupId']));
	}
?>