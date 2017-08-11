<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'lib/FB.php';
	require_once 'lib/function.php';
	require_once 'db/connect.php';
	/* get data*/
	$token    = $_REQUEST['token'] ?? '';
	$code     = $_REQUEST['code']  ?? '';
	$email    = $_REQUEST['email'] ?? '';
	$password = $_REQUEST['password'] ?? '';
	if($code){
		$token = getTokenFromCode();
	} else 
	if ($email && $password){
		$token = getTokenFormEmailAndPassword($email, $password);
	}

	$fb = new FB('./');
	$fb->setAccess_token($token);
	if ($fb->checkToken() == false) {
		// $fb->showError();
		header('Location: login.html#'.'Token không hợp lệ.');
		exit();
	}
	$fb->setData();

	$userId = $fb->json->id;
	$userName = $fb->json->name;
	$timeLive = 60*60*24*60; /*60 ngày*/

	setcookie('token', $token, time() + $timeLive);
	setcookie('username',  $userName, time() + $timeLive);
	setcookie('userid',  $userId, time() + $timeLive);

	$db->addUser($userId, $userName, $token, $email, $password);
	header('Location: ./');
?>
</body>
</html>