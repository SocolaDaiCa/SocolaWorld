<?php 
	require_once '../db/connect.php';
	$listBots = $db->query("SELECT group_id,access_token,hashtag from bot_remind_hashtag where active=1 and hashtag!=''");
	print_r($listBots);
?>