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
		<style>
			table img{
				height: 36px;
				width: 36px;
			}
		</style>
	</head>
	<body id="statistics">
		<div class="container">
			<div class="col-md-8 col-lg-8">
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
					</div>
					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Thành viên</th>
								<th>Bài đăng</th>
								<th>Đã cmt</th>
								<th>Được rep</th>
								<th>Đã reac</th>
								<th>Được reac</th>
								<th>Điểm số</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="record in members.list | orderBy 'score' -1">
								<td><img src="{{record.rank}}" alt=""></td>
								<td>
									<img src="https://graph.facebook.com/{{record.id}}/picture?type=large&redirect=true&width=40&height=40" class="img-circle"alt="">
									<a href="https://fb.com/{{record.id}}" target="_blank" title="">{{record.name}}</a>
								</td>
								<td>{{record.post}}</td>
								<td>{{record.comments.out}}</td>
								<td>{{record.comments.in}}</td>
								<td>{{record.reactions.out}}</td>
								<td>{{record.reactions.in}}</td>
								<td>{{record.score}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
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