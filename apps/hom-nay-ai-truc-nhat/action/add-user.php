<pre>
<?php 
	require_once '../../../db/connect.php';
	// $_GET = [
	// 	'groupID' => '710340422434287'
	// ];
	[
		'groupID' => $groupID
	] = $_GET;
	[
		'token' => $token
	] = $_COOKIE;
	$string = file_get_contents("https://graph.facebook.com/$groupID?fields=members.limit(1000){name,picture{url}}&access_token=$token");
	$listMembers = json_decode($string)->members->data;
	print_r($listMembers);
	$counter = 0;
	$stmt = $db->conn->prepare("INSERT INTO lich_truc_nhat (group_id, user_id, user_name, avatar, counter) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssi", $groupID, $userID, $userName, $avatar,  $counter);

	foreach ($listMembers as $key => $member) {
		$userID = $member->id;
		$userName = $member->name;
		$avatar = $member->picture->data->url;
		// echo($avatar . "<br>");
		$stmt->execute();
	}
?>