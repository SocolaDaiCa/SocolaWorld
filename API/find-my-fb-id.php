<?php
	require_once '../lib/function.php';	
	function findIdUsingToken($q, $token)
	{
		if(isset($token) && empty($token)){
			$token = 'EAACW5Fg5N2IBAP3RlQh6vMgkdWGcoqJxZCJtNTNMyS5lVzGZClYLwe00rjXR8ixSfTGsZClZAtLXbWv0cMsxjpAsMH4noSOx6E2DDFGQXx91Jxp1KoXK4RIR0CgolTzGn8dxHMFcuAntZAPZBcJDkRTyFmbJxbSMm3QotPgJnXCZBfI49QiCZCojlOBrgt3A7N8ZD';
		}
		$urlGraph = "https://graph.facebook.com/?ids={$q}&fields=id&access_token={$token}";
		// $idTarget = getJSON($urlGraph)->$q->id;
		// return $idTarget;
		return getJSON($urlGraph);
	}
	function findIdNoToken($q)
	{
		$id = explode('/', $q);
		$id = array_pop($id);
		$url = "https://facebook.com/{$id}";
		$id = viewsource($url);
		$id = explode('"entity_id":"', $id)[1];
		$id = explode('"', $id)[0];
		return $id;
	}
	// $q= 'https://www.facebook.com/SocolaDaiCa1997';
	// $q= 'SocolaDaiCa1997';
	// $q = 'https://www.facebook.com/tuannq.bk';
	if (!empty($_GET['q'])) {
		$q = $_GET['q'];
	} else {
		return;
	}
	if(isset($_GET['token'])){
		$idTarget = findIdUsingToken($q, $_GET['token']);
	} else {
		$idTarget = findIdNoToken($q);
	}
	print_r($idTarget);
?>