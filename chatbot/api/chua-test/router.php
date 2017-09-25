<?php
	function actionWithUrl($url)
	{
		$keys = array(
			'4share.vn/f/'    => 'get-link-4share.php',
			'fshare.vn/file/' => 'get-link-fshare.php',
			'.jpg'            => 'change-image-style-anime.php',
			'nhaccuatui.com'  => 'get-link-nhaccuatui.php',
			'youtube.com'     => 'get-link-youtube.php'
		);
		foreach ($keys as $key => $API) {
			if(strpos($url, $key)){
				$_GET['url'] = $url;
				$_GET['image'] = $url;
				header("Location: {$API}?" . http_build_query($_GET));
				exit();
			}
		}
	}
	require_once 'define.php';
	require_once PATH_LIB . 'validate.php';

	$msg = $_GET['msg'];
	$msg = urldecode($msg);
	/* check link */
	$words = explode(' ', $msg);
	foreach ($words as $key => $value) {
		if(isURL($value)){
			actionWithUrl($value);
		}	
	}
	header('Location: talk.php?' . http_build_query($_GET));
?>