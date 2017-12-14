<?php
	$text  = $_GET["text"] ?? '';
	$key = "61251b4b-91da-42d5-b934-6e57d0e57c27";
	$languageCode = "vi";
	$ft = 1;

	require_once __DIR__ . '/construct.php';
	if(empty($text)){
		$bot->sendText("Nói gì đi");
		exit();
	}
	$res = getJSON("http://sandbox.api.simsimi.com/request.p", [
		"key"  => $key,
		"text" => $text,
		"lc"   => $languageCode,
		"ft"   => $ft,
	]);
	if(!empty($res->response))
		$bot->sendText($res->response);
?>

