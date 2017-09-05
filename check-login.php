<?php
	function loginFalse()
	{
		require_once __DIR__ . '/layout/iframe-login.php';
		exit();
	}
	session_start();
	$login = $_SESSION["login"] ?? false;
	require_once __DIR__ . '/lib/FB.php';
	require_once __DIR__ . '/lib/function.php';
	/* chưa đăng nhập nhưng autologin*/
	if(!$login && $_COOKIE['auto_login']){
		$fb = new FB('./');
		$fb->setToken($_COOKIE['token'] ?? '');
		if(!$fb->checkToken()){
			$_SESSION["login"] = $login = false;
			setcookie('auto_login',  'false', time() - 5184000);
			loginFalse();
		} else {
			$_SESSION["login"] = $login = true;
		}
	}
	/* nếu chưa đăng nhập*/
	if (!$login){
		loginFalse();
		// die(header('Location: /login.php'));
	}
?>