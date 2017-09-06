<?php require_once __DIR__ . '/../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rank friends</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/insight.css">
	</head>
	<body id="statistics">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<div class="col-md-8 col-lg-8">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<i class="fa fa-bar-chart"></i> Bảng xếp hạng thành viên
						<a href="" title="../rank/{{idGroup}}" target="_blank">View</a>
					</div>
					<div class="panel-body">
						<!-- chọn nhóm -->
						<div class="form-group">
							<div class="input-group">
								<select  title="Pick a number" class="form-control" id="list-groups">
									<option v-for="group in groups" data-id-group="{{group.id}}">{{group.name}}</option>
								</select>
								<span class="input-group-btn">
									<button type="button" v-on:click="start" class="btn btn-primary">Bắt đầu</button>
								</span>
							</div>
						</div>
						<div class="form-group">
							<!-- phạm vi quét -->
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
								Phạm vi quét:
								<div class="radio">
									<label><input type="radio" v-model="interval" value="30" checked>30 Ngày</label>
								</div>
								<div class="radio">
									<label><input type="radio" v-model="interval" value="7">7 Ngày</label>
								</div>
								<div class="radio">
									<label><input type="radio" v-model="interval" value="1">1 Ngày</label>
								</div>
							</div>
							<!-- setup điểm tương ứng -->
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
								Điểm thưởng:
								<!-- Post comment -->
								<div class="form-group">
									<label class="control-label set-width" for="">Post</label>
									<input type="text" v-model="score.post" class="form-control set-width" id="" placeholder="">
									<label class="control-label set-width" for="">Cmt</label>
									<input type="text" v-model="score.comment" class="form-control set-width" id="" placeholder="">
								</div>
								<!-- like love -->
								<div class="form-group">
									<label class="control-label set-width" for="">Like</label>
									<input type="text" v-model="score.like" class="form-control set-width" id="" placeholder="">
									<label class="control-label set-width" for="">Love</label>
									<input type="text" v-model="score.love" class="form-control set-width" id="" placeholder="">
									<label class="control-label set-width" for="">Haha</label>
									<input type="text" v-model="score.haha" class="form-control set-width" id="" placeholder="">
								</div>
								<!-- haha wow -->
								<div class="form-group">
									<label class="control-label set-width" for="">Wow</label>
									<input type="text" v-model="score.wow" class="form-control set-width" id="" placeholder="">
									<label class="control-label set-width" for="">Sad</label>
									<input type="text" v-model="score.sad" class="form-control set-width" id="" placeholder="">
									<label class="control-label set-width" for="">Angry</label>
									<input type="text" v-model="score.angry" class="form-control set-width" id="" placeholder="">
								</div>
							</div>
						</div>
					</div>
					<table class="table" id="list-members">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Thành viên</th>
								<th v-on:click="sortPost">Bài đăng</th>
								<th v-on:click="sortCommentOut">Đã cmt</th>
								<th v-on:click="sortCommentIn">Được rep</th>
								<th v-on:click="sortReactionOut">Đã reac</th>
								<th v-on:click="sortReactionIn">Được reac</th>
								<th v-on:click="sortScore">Điểm số</th>
							</tr>
						</thead>
						<tbody>
							<tr v-if="end.all" v-for="record in members.list">
								<td><img src="/images/rank/{{record.rank}}.png" alt=""></td>
								<td>
									<img src="https://graph.facebook.com/{{record.id}}/picture?type=large&redirect=true&width=60&height=60" class="img-circle"alt="">
									<a href="https://fb.com/{{record.id}}" target="_blank" title="">{{record.name}}</a>
								</td>
								<td>{{record.posts}}</td>
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
					<div class="panel-heading">
						Thống kê tương tác {{intervalView}}
					</div>
					<div class="panel-body">
					</div>
					<table class="table">
						<tr>
							<td>Quét thông tin thành viên</td>
							<td><i class="{{icon.members}}"></i></td>
							<td class="text-center">{{members.real}}/{{members.total}}</td>
						</tr>
						<tr>
							<td>Bài viết đã quét bình luận</td>
							<td><i class="{{icon.postHasScanComments}}"></i></td>
							<td class="text-center">{{post.hasScanComments}}/{{post.total}}</td>
						</tr>
						<tr>
							<td>Bài viết đã quét rection</td>
							<td><i class="{{icon.postHasScanReaction}}"></i></td>
							<td class="text-center">{{post.hasScanReaction}}/{{post.total}}</td>
						</tr>
						<tr>
							<td>Tổng số bài viết</td>
							<td><i class="{{icon.post}}"></i></td>
							<td class="text-center">{{post.total}}</td>
						</tr>
						<tr>
							<td>Tổng số bình luận</td>
							<td><i class="{{icon.comments}}"></i></td>
							<td class="text-center">{{comments.total}}</td>
						</tr>
						<tr>
							<td>Tổng số reaction</td>
							<td><i class="{{icon.reactions}}"></i></td>
							<td class="text-center">{{reactions.total}}</td>
						</tr>
						<tr>
							<td>Thành viên hoạt động</td>
							<td></td>
							<td class="text-center">{{members.active}}/{{members.total}}</td>
						</tr>
					</table>
				</div>
				<table class="table table-hover table-input">
					<thead>
						<tr>
							<th></th>
							<th class="text-center">Posts dont care</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="post in listPostsDontCare">
							<td><i class="fa fa-check-square-o"></i></td>
							<td><input type="text" name="" id="input" class="form-control" value="{{post}}" required="required" pattern="" title=""></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
<?php require_once '../../layout/js.php'; ?>
<!-- <script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="/vendor/socola.dai.ca/js/fb.js"></script>
<script src="/vendor/vue/vue.min.js"></script> -->
<script src="js/check-rank.js"></script>