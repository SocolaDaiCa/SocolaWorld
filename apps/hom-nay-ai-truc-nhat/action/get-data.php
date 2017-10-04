<?php 
	require_once '../../../db/connect.php';
	['groupID' => $groupID] = $_GET;
	$sql = "SELECT user_id,user_name,avatar,counter from lich_truc_nhat where group_id='$groupID' order by counter, user_name ASC";
	// echo($sql);
	$listUser = $db->query($sql);
	echo(json_encode($listUser));
?>