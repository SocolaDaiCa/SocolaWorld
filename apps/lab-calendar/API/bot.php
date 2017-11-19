<?php
	require_once __DIR__ . '/../Controller/Controller_User.php';
	// require_once '../Model/Model_User.php';
	// $mUser = new Model_User();
	
	
	// echo($nowDay);
	// lấy thông tin của toàn bộ các ca trong từng ngày
	$cUser = new Controller_User;
	$request = $_GET['q'] ?? '';
	switch ($request) {
		case 'get_list_calendar':
			$calendar = $cUser->getListCalendar();
			echo json_encode($calendar);
			break;
		case 'registrationCalendar':
			$cUser->registrationCalendar(json_decode(json_encode($_POST)));
			break;
		default:
			break;
	}


// 	$registration_time = date("d/m/Y H:i:s");
// 	// get data from user
// 	[
// 		'day' => $day
// 	] = $_GET;
// 	echo($day . '<br>');
// 	echo($registration_time);
// ?>