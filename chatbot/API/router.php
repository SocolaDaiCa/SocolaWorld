<?php
	function actionWithUrl($url)
	{
		$keys = array(
			'4share.vn/f/' => 'get-link-4share.php',
			'fshare.vn/file/' => 'get-link-fshare.php',
			'.jpg' => 'change-image-style-anime.php', 
		);
		foreach ($keys as $key => $value) {
			if(strpos($url, $key)){
				$_GET['url'] = $url;
				$_GET['image'] = $url;
				// echo "Location: {$value}?" . http_build_query($_GET);
				header ("Location: {$value}?" . http_build_query($_GET));
				// echo "ngu";
				exit();
			}
		}
		// echo 'link';
	}
	require_once 'define.php';
	require_once PATH_LIB . 'validate.php';
	// $msg = $_GET['msg'];
	// $GET = array(
	// 	'msg' => 
	// );
	// echo urlencode('socola đại ca https://facebook.com/s.jpg');
	$msg = $_GET['msg'];
	// $msg = urldecode($msg);
	// $msg = 'Socola Đại Ca https://www.fshare.vn/file/7UFBZQHWT4SFHUI';
	// $msg = 'Socola Đại Ca http://4share.vn/f/2612121610101f14/8.1Enter_www.Key4VIP.info.rar';
	// $msg = 'Socola Đại Ca https://facebook.com';
	// echo $msg;
	/* check link */
	$words = explode(' ', $msg);
	// foreach ($words as $key => $value) {
	// 	if(isURL($value)){
	// 		actionWithUrl($value);
	// 	}	
	// }
	// echo "router";
	header('Location: talk.php?' . http_build_query($_GET));
?>