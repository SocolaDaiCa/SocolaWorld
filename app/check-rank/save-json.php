<?php
	set_time_limit(0);
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	require_once __DIR__ . '/../db/connect.php';
	   // die('11111');
	/* chỉ admin hoặc những id đc cho phép mới có quyền lưu data*/
	/* các biến cần dùng*/
	$admin = array(
		'100006907028797',
		'100006487845973'
	);
	$permission = false; /* quyền*/
	$token      = $_COOKIE['token'];
	$groupId    = $_POST['g'];
	$data = $_POST['d'];
	$updateTime = strtotime('now');
	// print_r($data);
	// $data->last = '1997';
	/* lấy id người dùng*/
	$userId = json_decode(file_get_contents("https://graph.facebook.com/v2.10/me?fields=id&access_token={$token}"))->id;
	/* check admin*/
	if(in_array($userId, $admin)){
		$permission = true;
	} else {
		$listGroup = json_decode(file_get_contents("https://graph.facebook.com/v2.10/me?fields=groups.limit(1000){administrator}&access_token={$token}"))->groups->data;
		foreach ($listGroup as $key => $group) {
			if ($group->id === $groupId) {
				if($group->administrator){
					$permission = true;
				}
				break;
			}
		}
	}
	
	if ($permission) {
		$db->saveInsightGroup($groupId, $updateTime, $data);
		// file_put_contents($fileName, json_encode($data)); /* lưu nén*/
		// file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT)); /* lưu đẹp*/
		echo('đã lưu');
	} else {
		echo('bạn không phải admin nên k thể lưu dữ liệu');
	}
	// ;
	// 
// file_put_contents('zz.json', );
?>