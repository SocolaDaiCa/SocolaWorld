<?php
	session_start();
	require_once __DIR__ . '/lib/Socola-graph-fb.php';
	require_once __DIR__ . '/Comtroller/Controller_User.php';
	require_once __DIR__ . '/Model/Model_User.php';
	$cUser = new Controller_User();
	$mUser = new Model_User();
	$graph = new SocolaGraphFacebook();
	// header('Content-Type: text/html; charset=utf-8');
	// require_once 'lib/FB.php';
	// require_once 'lib/function.php';
	// require_once 'db/connect.php';
	// /* get data*/
	// $loginWithFacebook = isset($_REQUEST['loginwithfacebook_x']);
	$token     = $_REQUEST['token'] ?? '';
	$code      = $_REQUEST['code']  ?? '';
	$email     = $_REQUEST['email'] ?? '';
	$password  = $_REQUEST['password'] ?? '';
	$autoLogin = isset($_REQUEST['autologin']) && $_REQUEST['autologin'] == 'on' ? true : false;

	// if($loginWithFacebook){
	// 	die(loginWithFacebook($_GET['u']));
	// }
	// if($code){
	// 	$token = getTokenFromCode();
	// } else 
	// if ($email && $password){
	// 	$token = $cUser->getTokenFormEmailAndPassword($email, $password);
	// }
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
	// $fb = new FB('./');
	// $fb->setAccess_token($token);
	// if ($fb->checkToken() == false) {
	// 	// $fb->showError();
	// 	$_SESSION["login"] = false;
		
	// 	exit();
	// }
	// $fb->setData();

	// $userId = $fb->json->id;
	// $userName = $fb->json->name;


	// $db->addUser($userId, $userName, $token, $email, $password);
	// $_SESSION["login"] = true;
	// $_SESSION['u'] = '';
?>