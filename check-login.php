<?php
	session_start();
	require_once __DIR__ . '/lib/FB.php';
	require_once __DIR__ . '/lib/function.php';
	
	$login = $_SESSION["login"] ?? false;
	$autoLogin = $_COOKIE['auto_login'] ?? false;
	/* chưa đăng nhập nhưng autologin*/
	if(!$login && $autoLogin){
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
		die(header('Location: /login.php'));
	}
?>