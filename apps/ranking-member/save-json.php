<?php
	set_time_limit(0);
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	require_once __DIR__ . '/../../Model/Model_App.php';

	$mApp = new Model_App;
	$updateTime = strtotime('now');
	$permission = true; /* quyền*/
	$jsonString    = $_POST['d'];
	$groupId = $_POST['g'];
	
	$mApp->saveInsightGroup($groupId, $updateTime, $jsonString);
?>