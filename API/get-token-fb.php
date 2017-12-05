<?php
	$username = $_REQUEST['u'] ?? '';
	$password = $_REQUEST['p'] ?? '';
	$type     = $_REQUEST['t'] ?? 'android';
?>
<?php if (empty($username . $password)): ?>
	<?php require_once __DIR__ . '/../Views/layout/css.php'; ?>
	<div class="container">
		Hướng dẫn <br>
		<?=$_SERVER['HTTP_REFERER'] ?>?u={username}&p={password}&t={type} <br>
		type = ['android', 'iphone', 'iosforpage'];
	</div>
	<?php exit(); ?>
<?php endif ?>
<?php
	/* dev by Socola Đại Ca
	 * fb.com/SocolaDaiCa1997
	 */
	require_once __DIR__ . '/../vendor/socola.dai.ca/lib/graph-fb-Socola.php';
	if(empty($username) || empty($password)){
		die("error");
	}
	echo Graph::getToken($username, $password, $type);
?>