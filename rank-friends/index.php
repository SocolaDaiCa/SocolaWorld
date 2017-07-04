<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rank friends</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/socola.css">
		<link rel="stylesheet" href="css/rank-friends.css">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
					<table class="table">
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
						<button type="button" id="list-posts" class="btn btn-primary hidden"></button>
					</div>
					<!-- Table -->
					<table class="table">
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
<script src="../js/lib/jquery.cookie.js"></script>
<script src="../js/FB.js"></script>
<script src="js/rank-friends.js"></script>