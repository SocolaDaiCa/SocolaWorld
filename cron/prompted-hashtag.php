<?php
	/*khởi tạo 1 vài giá tri*/
	$delimiter = array(' ', "\n");
	define('HASHTAG', '#socola');
	
	function checkHashtag($message)
	{
		/* cắt message thành từng từ để kiểm tra*/
		// $words = preg_split('/( |\n|\t)/', $post->message);
		// foreach ($words as $key => $word) {
		// 	# code...
		// }
		if(strpos($message, HASHTAG)){
			return TRUE;
		}
		return FALSE;
	}
	function promptedHashtag($idPost, $token)
	{https://graph.facebook.com/{$id}
		echo("thằng {$idPost} không có hashatag nhé <br>");
		$message = "Thêm hashtag vào nhé bạn";
		$message = urlencode($message);
		$urlGraph = "https://graph.facebook.com/{$idPost}/comments?method=post&access_token=$token&message={$message}";
		file_get_contents($urlGraph);
	}
	/*set token*/
	$token = !empty($_GET['token']) ? $_GET['token'] : 'EAACW5Fg5N2IBAP3RlQh6vMgkdWGcoqJxZCJtNTNMyS5lVzGZClYLwe00rjXR8ixSfTGsZClZAtLXbWv0cMsxjpAsMH4noSOx6E2DDFGQXx91Jxp1KoXK4RIR0CgolTzGn8dxHMFcuAntZAPZBcJDkRTyFmbJxbSMm3QotPgJnXCZBfI49QiCZCojlOBrgt3A7N8ZD';
	/*set id group*/
	$idGroup = !empty($_GET['idGroup']) ? $_GET['idGroup'] : '1892710067642670';
	$urlGraph = "https://graph.facebook.com/v2.10/{$idGroup}?fields=feed.limit(10){message}&access_token={$token}";
	$json = json_decode( file_get_contents($urlGraph) );
	$listPost = $json->feed->data;
	echo('<pre>');
	// print_r($listPost);
	/* kiểm tra xem đã có hashtag hay chưa*/
	foreach ($listPost as $key => $post) {
		// if($key > 0){
		// 	break;
		// }
		/* kiểm tra*/
		// if(empty($post->message)){
		// 	echo("$post->id nulllllllllllllll<br>");
		// } else {
		// 	echo("$post->id $post->message<br>");
		// }
		if(empty($post->message) || !checkHashtag($post->message)){
			promptedHashtag($post->id, $token);
		}
	}
?>