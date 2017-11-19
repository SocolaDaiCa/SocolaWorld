<?php 
	$key = $_GET['key'] ?? '';
	require_once '../../Controller/Controller.php';
	$db = new Controller;
	$sql = "SELECT * from `group` where group_id='$key' or group_email='$key'";
	// echo $sql;
	$data = $db->query($sql);
	if(empty($data)){
		$data = [['710340422434287', 'Class 2 CNTT K56 UTC HN', 'CNTT2.K56.UTC']];
	}
	[$groupID, $groupName, $groupEmail] = $data[0];
	echo("<script>var groupID = '$groupID';</script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Hôm nay ai trực nhật - <?php echo$groupName ?></title>
		<?php require_once '../../Views/layout/header.php'; ?>
		<meta name="keywords" content="Hom nay ai truc nhat"/>
		<meta name="description" content="Hôm nay ai trực nhật?">
		<link rel="image_src" href="/frontend/images/nu-cuoi-phan-dien.jpg"/>
		<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&amp;subset=vietnamese" rel="stylesheet">
		<link rel="stylesheet" href="style.css?htdesignz.net" type="text/css" />
	</head>
	<body id="app">
		<h1>Hôm nay ai trực nhật <br> <?php echo$groupName ?></h1>
		<div id="queue">
			<span class="title">LƯỢT ƯU TIÊN</span>
			<div v-for="(index, user) in listUser" class="user-div" data-id="{{user[0]}}">
				<span class="id">{{index +1}}</span>
				<span class="avatar white">s<img v-bind:src="user.avatar" alt=""></span>
				<span class="name"><a href="//fb.com/{{user.user_id}}" title="" target="_blank">{{user.user_name}}</a></span>
				<span class="button button-queue white">queue</span>
				<span style="width: 24px;"></span>
				<span class="button button-down white">done</span>
				<span style="width: 24px;"></span>
				<span class="id ">{{user.counter}}</span>
			</div>
		</div>
		<!-- <div id="order">
			<span class="title">LƯỢT MẶC ĐỊNH</span>
			<?php
			// foreach ($save->order as $order) {
			// echo '<div id="user-'.$order.'" class="user-div" data-id="'.$order.'"><span class="id">'.$order.'</span><span class="avatar"
			// style="background-image: url(\''.$data[$order]['photo'].'\')">
			// </span><span class="name">'.$data[$order]['name'].'</span> <a class="button button-down">done</a> <a class="button button-queue">queue</a></div>';
			// }
			?>
		</div> -->
		<!-- <div class="save"><a class="button button-save">save order</a></div> -->
		<?php require_once '../../Views/layout/js.php'; ?>
		<script src="hom-nay-ai-truc-nhat.js"></script>
	</body>
</html>