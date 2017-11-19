<?php
	require_once 'construct.php';
	require_once PATH_DB . 'connect.php';
	function randomImage()
	{
		global $conn;
		$query = "SELECT count(id) AS total_records FROM girl";
		$result = $conn->query($query);
		$row = mysqli_fetch_assoc($result);
		$total_records = $row['total_records'];	

		$record_index = rand(0,$total_records - 1);
		$result = $conn->query("SELECT url FROM girl LIMIT $record_index, 1");
		$row = mysqli_fetch_assoc($result);
		$image = $row['url'];

		$conn->close();
		return $image;
	}
	$image = randomImage();
	$bot->sendImage($image);
?>