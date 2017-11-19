<?php 
	/* host/API/talk.php?msg={{msg}}*/
	require_once 'construct.php';
	require_once PATH_LIB . 'curl.php';
	
	$textUserSend = $_REQUEST['msg'];
	$textUserSend = urlencode($textUserSend);

	$url = "http://api.mobico.info/messenger/ask/content/{$textUserSend}/format/json";
	$text = getJSON($url)->content;
	$bot->sendText($text);
?>