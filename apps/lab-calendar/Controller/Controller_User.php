<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../Model/Model_User.php';
	$mUser = new Model_User();
	class Controller_User extends Controller
	{
		function __construct()
		{
		}
		public function registrationCalendar($date, $ca, $lydo)
		{
			[
				"userid" => $userID
			] = $_COOKIE;
			$date = date("Y-m-d", strtotime($date));
			$this->run("INSERT INTO queue (user_id, date, ca, lydo) VALUES('$userID', '$date', '$ca', '$lydo')");
		}
		public function getListCalendar()
		{
			global $mUser;
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$dayOfWeek = date("w");
			$nowDay    = date("d/m/Y");
			$calendar  = array();
			// $calendar[] = [[],[],[],[]];
			for ($i=1; $i <=6; $i++) {
				$date = date("Y-m-d", strtotime("+" . $i . " day"));
				$data = array();
				for ($ca=1; $ca <= 5; $ca++) {
					$sql = "SELECT user_name, date, ca, registration_time from `queue` JOIN  `user` ON user.user_id = queue.user_id where `date`='$date' and ca='$ca' ";
					$data[] = $mUser->query($sql);
				}
				$date = date("d/m/Y", strtotime("+" . $i . " day"));
				$day = date("l", strtotime("+" . $i . " day"));
				$calendar[] = array(
					"day" => $day,
					"date" => $date,
					"calendar" => $data
				);
			}
			return json_decode(json_encode($calendar));
		}
	}
?>