<?php
// nếu mọi thứ đều ổn
	if(!empty($_COOKIE['userid']) && ($_COOKIE['userid'] =='100006907028797' || $_COOKIE['userid'] == '1848989518674598')){
	} else {
		// không ổn thì sao
		echo("fasle");
		return;
	}
	require_once '../../../db/connect.php';
	[
		'groupID' =>$groupID,
		'userID' => $userID
	] = $_GET;
	$sql = "SELECT counter from lich_truc_nhat where user_id='$userID' and group_id='$groupID'";
	// echo($sql);
	$counter = $db->query($sql)[0][0] + 1;
	$db->run("UPDATE lich_truc_nhat set counter='$counter' where  user_id='$userID' and group_id='$groupID'");
	echo("done");
?>