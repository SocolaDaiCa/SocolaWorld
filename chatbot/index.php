<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	xong
</body>
</html> -->
<?php 
	$text = $_REQUEST['text'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	// $referrer = $_SERVER['HTTP_REFERER'];
	// \n$referrer
	file_put_contents("res.txt" ,"$text\n$ip\n$browser");
 	// if ($referred == "") {
	  // $referrer = "This page was accessed directly";
	  // }
	echo('sdsds');
?>