<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Lọc bình luận</title>
		<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<br><br>
		<div class="container">
			<!-- input form -->
			<form action="" method="POST" role="form" style="max-width: 600px; margin: auto">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">ID bài viết</span>
						<input type="text" id="id-status" class="form-control" placeholder="Id status" value="100004399725901_852114151611901">
						<span class="input-group-btn">
							<button id="filter-comments" class="btn btn-secondary" type="button">Filter!</button>
						</span>
					</div>
				</div>
			</form>
			<!-- / input form -->
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Toàn bộ bình luận</a></li>
				<li><a data-toggle="tab" href="#menu1">Chỉ bình luận chứa Email</a></li>
				<li><a data-toggle="tab" href="#menu2">Chỉ bình luận chứa số điện thoại</a></li>
			</ul>
			<div class="tab-content" id="list-comments">
				<!-- bảng chứa tất cả bình luận -->
				<div id="home" class="tab-pane fade in active">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Usename</th>
								<th>Bình luận</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="comment in allComments">
								<td><a href="/" title="">{{comment.from.name}}</a></td>
								<td>{{comment.message}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- bảng chứa bình luận có mail -->
				<div id="menu1" class="tab-pane fade">
					Nếu có nhiều email, thì mình chỉ lọc ra email đầu tiên tìm được
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Usename</th>
								<th>Bình luận chứa email</th>
								<th>Email tìm thấy</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="comment in commentsHasMail">
								<td>{{comment.from.name}}</td>
								<td>{{comment.message}}</td>
								<td>{{comment.mail}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- bảng chứa bình luận có số điện thoại -->
				<div id="menu2" class="tab-pane fade">
					Nếu có nhiều số điện thoại trong một bình luận, mình chỉ lọc ra số điện thoại đầu tiên tìm được
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Usename</th>
								<th>Bình luận chứa số điện thoại</th>
								<th>Số điện thoại tìm thấy</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="comment in commentsHasPhone">
								<td>{{comment.from.name}}</td>
								<td>{{comment.message}}</td>
								<td>{{comment.phone}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../../vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="../../vendor/vue/vue.min.js"></script>
<script src="../../vendor/socola-dai-ca/js/fb.js"></script>
<script src="js/filter-comments.js"></script>
<script src=""></script>