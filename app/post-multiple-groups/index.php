<?php require '../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Post Multiple Groups</title>
		<?php require '../../layout/header.php'; ?>
		<?php require '../../layout/css.php'; ?>
		<link rel="stylesheet" type="text/css" href="post-multiple-groups.css">
	</head>
	<body id="app">
		<?php require '../../layout/nav.php'; ?>
		<div class="container">
			<div class="text-center">
				<h1>Post Multiple Groups</h1>
				<p>Đăng lên nhiều nhóm cùng lúc.</p>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div id="new-post">
					<div class="media">
						<div class="media-left">
							<img src="../../frontend/images/Socola.jpg" class="media-object" style="width:36px">
						</div>
						<div class="media-body">
							<!-- <h4 class="media-heading">John Doe</h4> -->
							<!-- <p>Lorem ipsum...</p> -->
							<div class="form-group">
								<textarea name="" id="input" class="form-control" required="required" onkeyup="auto_grow(this)" placeholder="Bạn đang nghĩ gì?"></textarea>
							</div>
							<button type="button" class="btn btn-primary btn-small pull-right">Đăng</button>
						</div>
						<!-- <div class="">
							
						</div> -->
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				Danh sách nhóm
				<div class="form-group">
					<div class="checkbox" v-for="group in listGroups">
						<label>
							<input type="checkbox" value="">
							{{group.name}}
						</label>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php require '../../layout/js.php'; ?>
<script src="post-multiple-groups.js"></script>