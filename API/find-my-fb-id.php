<?php if (empty($_REQUEST)): ?>
<?php require_once __DIR__ . '/../Views/layout/css.php'; ?>
<div class="container">
	Cú pháp <br>
	<?=$_SERVER["HTTP_REFERER"]?>?q={user_scope_id} <br>
	Mẫu <br>
	<a href="<?=$_SERVER["HTTP_REFERER"]?>?q=socola1997" title=""><?=$_SERVER["HTTP_REFERER"]?>?q=socola1997</a>
</div>
<?php exit(); ?>
<?php endif ?>
<?php
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	$token = $_REQUEST['token'] ?? "EAACW5Fg5N2IBAEo4h8wUnMAFe3qwhwg7CEtTt0fkDV430pYL8mr9o9MeTq3oUN589dZC395FGWMLq9zAejklZB5VPihArC5bCL60LBQFzZAqod9AJuoEMshoPP2ZCqhG6rqbglgwoMw11PYrpxsOVfPqjyE0aveYQV7oWYrJ27YzGo5tq2ZAD2YyHLlUjvt0ZD";
	$q = $_REQUEST['q'] ?? '';
	if (empty($q)) return;
	$urlGraph = "https://graph.facebook.com/?" . http_build_query([
		'ids' => $q,
		'fields'=>'id',
		'access_token'=> $token
	]);
	$data = json_decode(file_get_contents($urlGraph));
	echo $data->$q->id;
	// function findIdUsingToken($q, $token)
	// {
			// 	if(isset($token) && empty($token)){
					// 		$token = 'EAACW5Fg5N2IBAP3RlQh6vMgkdWGcoqJxZCJtNTNMyS5lVzGZClYLwe00rjXR8ixSfTGsZClZAtLXbWv0cMsxjpAsMH4noSOx6E2DDFGQXx91Jxp1KoXK4RIR0CgolTzGn8dxHMFcuAntZAPZBcJDkRTyFmbJxbSMm3QotPgJnXCZBfI49QiCZCojlOBrgt3A7N8ZD';
			// 	}
		//
			// 	// $idTarget = getJSON($urlGraph)->$q->id;
			// 	// return $idTarget;
			// 	return getJSON($urlGraph);
	// }
	// function findIdNoToken($q)
	// {
			// 	$id = explode('/', $q);
			// 	$id = array_pop($id);
			// 	$url = "https://facebook.com/{$id}";
			// 	$id = viewsource($url);
			// 	$id = explode('"entity_id":"', $id)[1];
			// 	$id = explode('"', $id)[0];
			// 	return $id;
	// }
	// // $q= 'https://www.facebook.com/SocolaDaiCa1997';
	// // $q= 'SocolaDaiCa1997';
	// // $q = 'https://www.facebook.com/tuannq.bk';
	// if (!empty($_GET['q'])) {
			// 	$q = $_GET['q'];
	// } else {
			// 	return;
	// }
	// if(isset($_GET['token'])){
			// 	$idTarget = findIdUsingToken($q, $_GET['token']);
	// } else {
			// 	$idTarget = findIdNoToken($q);
	// }
	// print_r($idTarget);
?>
