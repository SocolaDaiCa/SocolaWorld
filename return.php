<?php
	session_start();
	require_once __DIR__ . '/lib/Socola-graph-fb.php';
	require_once __DIR__ . '/Comtroller/Controller_User.php';
	require_once __DIR__ . '/Model/Model_User.php';
	$cUser = new Controller_User();
	$mUser = new Model_User();
	$graph = new SocolaGraphFacebook();
	$token     = $_REQUEST['token'] ?? '';
	$code      = $_REQUEST['code']  ?? '';
	$email     = $_REQUEST['email'] ?? '';
	$password  = $_REQUEST['password'] ?? '';
	$autoLogin = isset($_REQUEST['autologin']) && $_REQUEST['autologin'] == 'on' ? true : false;
	if($graph->isTokenLive($token)){
		[
			'id' => $userID,
			'name' => $username
		]= $graph->getInfoUser();
		$mUser->addUser($userID, $username, $token, $email, $password);
		$cUser->setcookie($userID, $username, $token, $autoLogin);
		die(header('Location: .' . $_SESSION['u'] ?? '/'));
	}
	header('Location: login.php?error='. urlencode('Token không hợp lệ.'));
?>