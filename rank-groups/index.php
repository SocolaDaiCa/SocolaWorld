<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rank friends</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/socola.css">
		<link rel="stylesheet" href="../rank-friends/css/rank-friends.css">
	</head>
	<body>
		<div class="loading">
			<div id="loader"></div>
			<div id="percent">0%</div>
		</div>
		<div class="container">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">Thống kê tương tác</div>
					<div class="panel-body">
						<button type="button" id="list-friends" class="btn btn-primary">Bắt đầu</button>
						<div id="thong-ke">
							<p id="count-friends"></p>
						</div>
					</div>
					
					<!-- Table -->
					<table class="table index">
						<thead>
							<tr>
								<td>index</td>
								<th>Friends or followers</th>
								<th>Reaction</th>
								<th>Comments</th>
								<th>Score</th>
							</tr>
						</thead>
						<tbody id="result-listfriends">
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">Danh sách bài viết</div>
					<div class="panel-body">
						<button type="button" class="btn btn-primary" id="list-posts" >posst</button>
						count <span id="count"></span>
					</div>
					<!-- Table -->
					<table class="table index">
						<thead>
							<tr>
								<th>index</th>
								<th>Id post</th>
							</tr>
						</thead>
						<tbody id="result-id-post">
						</tbody>
					</table>
				</div>
			</div>
			<!-- <label for="">Select list:</label>
			<select class="form-control" id="">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
			</select> -->
		</div>
	</body>
</html>
<script src="../js/lib/jquery-3.2.1.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/lib/jquery.cookie.js"></script>
<script src="../js/FB.js"></script>
<script src="js/rank-groups.js"></script>
<script src="../js/Percent.js"></script>
<script src="../js/check-rank.js"></script>