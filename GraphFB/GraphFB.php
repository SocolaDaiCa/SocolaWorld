<?php
	require_once '../lib/FB.php';
	require_once '../lib/function.php';
	$fb = new FB('../../');
	require_once '../checkLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="../../image/Socola.jpg">
	<title><?php echo($fb->name); ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/socola.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/blur.css">
	<link rel="stylesheet" href="../../css/giao_dien.css">
	<link rel="stylesheet" href="../../css/graph.css">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/list_groups.css">
	<link rel="stylesheet" href="../../css/respon.css">
</head>
<body>
	<?php //require_once '../menubar.php'; ?>
	<div class="bo_cuc">
		<div class="list_groups scrollbar"></div>

		<div class="time_line">
			<div class="cover"></div>
			<div class="next_cover">
				<div class="btn-group">
					<button type="button" class="btn btn-default">
						<b class="small text-muted">Đã tham gia</b>
						<i class="fa fa-sort-desc"></i>
						
					</button>
					<button type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-ok small" style="color: #6597FB"></span>
						<b class="small text-muted">Thông báo</b>
					</button>
				</div>
				<span class="so_bai_viet_tim_thay"></span>
			</div>
			<div id="newsfeed">
				<?php require_once '../loading.php'; ?>
			</div>
		</div>
	</div>
</body>
</html>
<script src="//code.jquery.com/jquery.js"></script>
<script src="../../js/lib/jquery.cookie.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="../../js/FB.js"></script>
<script src="../../js/socola.js"></script>
<script src="../../js/function.js"></script>
<script src="../../GraphFB/js/GraphFB.js"></script>
<script>
	$(document).ready(function(){
		var fb = new FB('../../');
		fb.getIdFromUrl();
		fb.setToken();
		fb.setCover();
		fb.listGroups();
		fb.newsFeed();
	});
</script>