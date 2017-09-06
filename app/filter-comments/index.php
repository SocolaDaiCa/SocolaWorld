<?php require_once '../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Lọc bình luận</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
	</head>
	<body id="app">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<!-- input form -->
			<div style="max-width: 600px; margin: auto">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">ID bài viết</span>
						<input type="text" v-model="idStatus" class="form-control" placeholder="Id status" value="">
						<span class="input-group-btn">
							<button v-on:click="filterComments" class="btn btn-secondary" type="button">Filter!</button>
						</span>
					</div>
				</div>
			</div>
			<!-- / input form -->
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Toàn bộ bình luận</a></li>
				<li><a data-toggle="tab" href="#menu1">Bình luận chứa Email</a></li>
				<li><a data-toggle="tab" href="#menu2">Bình luận chứa số điện thoại</a></li>
			</ul>
			<div class="tab-content" id="list-comments">
				<!-- bảng chứa tất cả bình luận -->
				<div id="home" class="tab-pane fade in active">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td></td>
								<th>Usename</th>
								<th>Bình luận</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(index,comment) in allComments">
								<td>{{index+1}}</td>
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
								<td></td>
								<th>Usename</th>
								<th>Bình luận chứa email</th>
								<th>Email tìm thấy</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(index, comment) in commentsHasMail">
								<td>{{index+1}}</td>
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
								<td></td>
								<th>Usename</th>
								<th>Bình luận chứa số điện thoại</th>
								<th>Số điện thoại tìm thấy</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(index, comment) in commentsHasPhone">
								<td>{{index+1}}</td>
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
<?php require_once '../../layout/js.php'; ?>
<script src="filter-comments.js"></script>