<pre>
<?php 
	$token = $_REQUEST['token'] ?? 'EAACW5Fg5N2IBAP3RlQh6vMgkdWGcoqJxZCJtNTNMyS5lVzGZClYLwe00rjXR8ixSfTGsZClZAtLXbWv0cMsxjpAsMH4noSOx6E2DDFGQXx91Jxp1KoXK4RIR0CgolTzGn8dxHMFcuAntZAPZBcJDkRTyFmbJxbSMm3QotPgJnXCZBfI49QiCZCojlOBrgt3A7N8ZD';
	$postId = $_REQUEST['id'] ?? '100007375086440_1949905585265259';
	$listComments = array();

	$json = json_decode(file_get_contents("https://graph.facebook.com/{$postId}?fields=comments.limit(500)&access_token={$token}"))->comments;
	// print_r(json_encode($json));
	$listComments = array_merge($listComments, $json->data);

	while (!empty($json->paging->next)) {
		$json = json_decode(file_get_contents($json->paging->next));
		$listComments = array_merge($listComments, $json->data);
	}
	$index = rand(0, sizeof($listComments) - 1);
	print_r($listComments[$index]);
?>