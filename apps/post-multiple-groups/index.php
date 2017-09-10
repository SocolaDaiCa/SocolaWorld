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
				<p>Viết bài lên nhiều nhóm chỉ với 1 lần đăng.</p>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div id="new-post">
					<div class="media">
						<div class="media-left">
							<img src="https://graph.facebook.com/<?php echo$_COOKIE['userid'] ?>/picture?type=large&redirect=true&width=100&height=100" class="media-object" style="width:55px">
						</div>
						<div class="media-body">
							<!-- <h4 class="media-heading">John Doe</h4> -->
							<div class="form-group">
								<textarea name="" id="input" class="form-control" required="required" onkeyup="auto_grow(this)" placeholder="Bạn đang nghĩ gì?" v-model="message"></textarea>
							</div>
							<div class="form-group">
								Tới: <span v-for="group in listGroupsWillPost">&nbsp;<span class="label label-primary">{{group.name}}</span> </span>
							</div>
							<button type="button" class="btn btn-primary btn-small pull-right" v-on:click="post">Đăng</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				Danh sách nhóm
				<div class="form-group">
					<div class="checkbox" v-for="group in listGroups">
						<label>
							<input type="checkbox" v-bind:value="group" v-model="listGroupsWillPost">
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