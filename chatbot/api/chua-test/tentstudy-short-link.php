<?php 
	require_once 'construct.php';
	require_once PATH_LIB . 'curl.php';

	$urlNeedShorted = $_GET['url'];
	$urlNeedCurl = 'https://short.tentstudy.xyz/api.php';
	$param = array(
		'url' => $urlNeedShorted
	);

	$json = getJSON($urlNeedCurl, $param, 'POST');
	
	if($json->success){
		$text = $json->url;
	} else{
		$text = $json->error;
	}

	$bot->sendText($text);
?>