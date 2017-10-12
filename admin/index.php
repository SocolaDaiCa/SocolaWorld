<?php 
	if (empty($_GET['page'])) {
		die(header('Location: /admin/dashboard'));
	}
	$page = $_GET['page'];
	require_once __DIR__ . '/../Model/Model_User.php';
	require_once __DIR__ . '/../Model/Model_Admin.php';
	$mAdmin = new Model_Admin();
	$mUser = new Model_User();
	// data
	[
		'id' => $id,
		'name' => $name,
		'avartar' => $avartar
	] = $mUser->getInfo();
	require_once __DIR__ . '/views/layout.php';
?>