<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rank friends</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../vendor/bootstrap-select/css/bootstrap-select.css">
		<link rel="stylesheet" href="/frontend/css/socola.css">
		<!-- <link rel="stylesheet" href="../rank-friends/css/rank-friends.css"> -->
		<link rel="stylesheet" href="/vendor/loading/loading-bar.css">
		<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
	</head>
	<body id="statistics">
		<div class="container">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">Bảng xếp hạng thành viên</div>
					<div class="panel-body">
						<!-- chọn nhóm -->
						<div class="input-group">
							<select  title="Pick a number" class="form-control" id="list-groups">
								<option v-for="group in groups" data-id-group="{{group.id}}">{{group.name}}</option>
							</select>
							<span class="input-group-btn">
								<button type="button" id="start" class="btn btn-primary">Bắt đầu</button>
							</span>
						</div>
						<div class="row text-center">
							<?php require_once 'page.php'; ?>
						</div>
					</div>
					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
								<th>socola</th>
								<th>Thành viên</th>
								<th colspan="2">Bình luận</th>
								<th colspan="2">Reaction</th>
								<th>Post</th>
								<th>Điểm số</th>
							</tr>
							<tr>
								<th></th><th></th>
								<th>in</th><th>out</th>
								<th>in</th><th>out</th>
								<th></th><th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="record in members.list">
								<td>{{}}</td>
								<td>{{record.name}}</td>
								<td>{{record.comments.in}}</td>
								<td>{{record.comments.out}}</td>
								<td>{{record.reactions.in}}</td>
								<td>{{record.reactions.out}}</td>
								<td>{{record.post}}</td>
								<td>{{record.score}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">Danh sách bài viết</div>
					<div class="panel-body">
						<table class="table">
							<tbody>
								<tr>
									<td>Quét thông tin thành viên</td>
									<td><i class="{{icon.members}}"></td>
									<td class="text-center">{{members.real}}/{{members.total}}</td>
								</tr>
								<tr>
									<td>Bài viết đã quét bình luận</td>
									<td><i class="{{icon.postHasScanComments}}"></i></td>
									<td class="text-center">{{post.hasScanComments}}/{{post.total}}</td>
								</tr>
								<tr>
									<td>Bài viết đã quét rection</td>
									<td><i class="{{icon.postHasScanReaction}}"></td>
									<td class="text-center">{{post.hasScanReaction}}/{{post.total}}</td>
								</tr>
								<tr>
									<td>Tổng số bài viết</td>
									<td><i class="{{icon.post}}"></td>
									<td class="text-center">{{post.total}}</td>
								</tr>
								<tr>
									<td>Tổng số bình luận</td>
									<td><i class="{{icon.comments}}"></td>
									<td class="text-center">{{comments.total}}</td>
								</tr>
								<tr>
									<td>Tổng số reaction</td>
									<td><i class="{{icon.reactions}}"></td>
									<td class="text-center">{{reactions.total}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/bootstrap-select/js/bootstrap-select.js"></script>
<script src="/vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="/vendor/socola-dai-ca/js/fb.js"></script>
<!-- <script src="../vendor/loading/loading-bar.js"></script> -->
<script src="/vendor/vue/vue.min.js"></script>
<script>
	// var bar1 = new ldBar("#myItem1", {
										// 	'preset': 'circle'
	// });
	// bar1.set(0);
</script>
<!-- <script src="../js/FB.js"></script> -->
<script src="js/check-rank.js"></script>
<!-- <script src="../js/Percent.js"></script> -->
<script src="page.js"></script>