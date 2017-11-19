<?php
	$page = $_GET['page'];
	if (empty($page)) {
		die(header('Location: /admin/dashboard'));
	}
	require_once __DIR__ . '/../Controller/Controller_Admin.php';
	$cAdmin = new Controller_Admin();
	// data
	[
		'id' => $id,
		'name' => $name,
		'avartar' => $avartar
	] = $cAdmin->getInfo();
	require_once __DIR__ . '/Views/layout.php';
?>