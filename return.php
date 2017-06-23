<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'lib/FB.php';
	require_once 'lib/function.php';
	require_once 'lib/DBconnect.php';

	if( !empty($_REQUEST['token']) )
		$access_token = $_REQUEST['token'];
	else
	if( !empty($_REQUEST['code']) )
		$access_token = getTokenFromCode();
	else
	if( !empty($_REQUEST['email']) && !empty($_REQUEST['password']))
		$access_token= getTokenFormEmailAndPassword($_REQUEST['email'], $_REQUEST['password']);

	$fb = new FB('./');
	$fb->setAccess_token($access_token);
	if ($fb->checkToken() == false) {
		$fb->showError();
		exit();
	};
	$fb->setData();

	$userid = $fb->json->id;
	$username = $fb->json->name;
	$timeLive = 60*60*24*60; /*60 ngày*/

	setcookie('token', $access_token, time() + $timeLive);
	setcookie('username',  $userid, time() + $timeLive);
	setcookie('userid',  $username, time() + $timeLive);

	$conn->query("INSERT INTO token VALUES ('$userid', '$username', '$access_token')");
	$conn->query("UPDATE `token` SET `id`='$userid',`name`='$username',`token`='$access_token' WHERE `id`='$userid'");
	$conn->close();
	header('Location: ./');
?>
</body>
</html>