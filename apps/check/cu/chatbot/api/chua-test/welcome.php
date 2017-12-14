<?php
/*	https://01b02091.ngrok.io/API/welcome.php
 *
 *
 */
	require_once 'construct.php';
	file_put_contents('data-user.txt', http_build_query($_GET, '', "\n"));
	[
		'first_name' => $first_name,
		'last_name'  => $last_name,
	] = $_GET;

	$text = array();
	$text[] = "Chào {$gender} {$last_name} {$first_name} {$beautiful} <3 .";
	$text[] = "{$me} có thể giúp gì cho ${gender} không ạ.";

	$bot->sendText($text);
 ?>