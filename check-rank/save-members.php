<!-- save members -->
<?php
	// header('Content-Type: text/html; charset=utf-8');
	set_time_limit(0);
	$json = $_POST['json'];
	$groupId = $_POST['groupId'];
	$arrUsers = json_decode($json);
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "check-rank";
	/*Create connection*/
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	// prepare and bind
	// $stmt = $conn->prepare("(?, ?, ?)");
	// $stmt->bind_param("sss", $groupId, $userId, $username);
	// set parameters and execute
	$arrSQL = array();
	foreach ($arrUsers as $key => $user) {
		$arrSQL[] = "('$groupId', '$user->id', '$user->name')";
		// $userId = ;
		// $username = ;
		// $stmt->execute();
	}
	$conn->query('INSERT INTO `user`(`groupId`, `userId`, `username`) VALUES '.implode(",", $arrSQL));
	$conn->close();
	echo('xong');
?>
xong