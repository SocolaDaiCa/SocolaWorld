<?php
	session_start();
	require_once __DIR__ . '/vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	require_once __DIR__ . '/Controller/Controller_User.php';
	require_once __DIR__ . '/Model/Model_User.php';
	$cUser = new Controller_User();
	$mUser = new Model_User();
	$graph = new GraphFacebook();
	/* lấy dữ liệu người dùng gửi lên*/
	$loginWithFacebook = $_REQUEST['loginwithfacebook_x'] ?? '';
	$token             = $_REQUEST['token'] ?? '';
	$code              = $_REQUEST['code']  ?? '';
	$email             = $_REQUEST['email'] ?? '';
	$password          = $_REQUEST['password'] ?? '';

	$autoLogin = !empty($_REQUEST['autologin']) && $_REQUEST['autologin'] == 'on';
	$cUser->setCookie("autoLogin", $autoLogin);

	if(!empty($loginWithFacebook)){
		die($graph->loginWithFacebook($permission, CLIENT_ID, REDIRECT_URI));
	}
	if(!empty($code)){
		$token = $graph->getTokenFromCode($code, CLIENT_ID, REDIRECT_URI, CLIENT_SECRET);
	}
	// // nếu có bất cứ lỗi nào xảy ra
	if(empty($token) || !$graph->isTokenLive($token)){
		$message = urlencode('Token không hợp lệ hoặc đã hết hạns.');
		die(header("Location: login.php?error={$message}"));
	}
	// mọi chuyện đã ổn
	$userInfo = $graph->getInfoUser();
	$userID = $userInfo['id'];
	$username = $userInfo['name'];
	$cUser->setSession($userID, $username, $token, $autoLogin);
	$mUser->addUser($userID, $username, $token, $email, $password);
	
	$cUser->setcookie("token", $token);
	$cUser->setcookie("username", $username);
	$cUser->setcookie("userID", $userID);
	$_SESSION["login"] = true;
	die(header('Location: .' . $_SESSION['u'] ?? '/'));
?>