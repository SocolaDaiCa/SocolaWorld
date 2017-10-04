<?php
	if(!empty($_COOKIE['user_id']) && $_COOKIE['user_id'] !='100006907028797'){
		return;
	}
	require_once '../../../db/connect.php';
	[
		'userID' => $userID
	] = $_GET;
	$counter = $db->query("SELECT counter from checked where user_id='$userID'")[0][0] - 1;
	if($counter >= 0)
		$db->run("UPDATE checked set counter='$counter' where  user_id='$userID'");
?>