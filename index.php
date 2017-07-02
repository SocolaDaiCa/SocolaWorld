<?php
	session_start();
	require_once './lib/FB.php';
	require_once './lib/function.php';
	$fb = new FB('./');
	$fb->setAccess_token($_COOKIE['token']);
	require_once 'checkLogin.php';
?>
<?php $time_start = strtotime("now"); ?>
<!DOCTYPE html>
<html lang="vn">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Socola Timeline</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/socola.css">
		<link rel="stylesheet" href="css/index.css">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/giao_dien.css">
		<script src="js/socola.js"></script>
		<script src="js/FB.js"></script>
		<style>
			.zz{
				box-shadow: 0px 0px 10px 1px #888888;
			}
			a, a:hover{
				display: block;
				/*text-decoration: none;*/
				color: black;}
		</style>
	</head>
	<body>
		<?php //require_once 'menubar.php'; ?>
		<div class="container" style="max-width: 800px; padding: 0px; padding-top: 60px;">
			<div class="btn-group">
				<a href="locMailComments" class="btn btn-default" target="_blank">Lọc Mail từ Comment</a>
				<a href="tool/check-token" class="btn btn-default">Check Live Token</a>
				<a href="logout.php" class="btn btn-default">Logout</a>
				<a href="tool" class="btn btn-default" title="">Tool</a>
			</div>
		</div>
		<div class="container">
			<div id="listGroups">
			</div>
		</div>
	</body>
</html>
<script src="js/lib/jquery.cookie.js"></script>
<script>
	function show_list_groups(json, all) {
		json.forEach(function(item, inex) {
			item.email = item.email.split('@')[0];
			var picture = item.picture.data.url;
			var name = item.name;
			var url = 'groups/'+item.email+'/'+item.id;
			var html='';
			html+='<div class="box_group">'+'<div class="picture_group">'+'<img src="'+picture+'" alt="" class="img-circle">'+'</div>'+'<div class="info_group">'+'<a href="'+url+'" class="name_group" title="">'+name+'</a>'+'asdasdsa'+'</div>'+'</div>';
			$('#listGroups').append(html);
		});
	}
	function getPrivacy(privacy) {
		switch(privacy){
			case 'OPEN':
				return'<i class="fa fa-globe text-primary" aria-hidden="true"></i>';
			case 'CLOSED':
				return '<i class="fa fa-unlock-alt text-success" aria-hidden="true"></i>';
			case 'SECRET':
				return '<i class="fa fa-lock text-danger" aria-hidden="true"></i>';
			default:
				return privacy;
		}
	}
	$(function() {
		var fb = new FB('./');
		fb.setToken();
		fb.listGroups();
	});
</script>