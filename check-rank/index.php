<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>sds</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../check-rank.css">
		<link rel="stylesheet" href="../../../css/socola.css">
		<script src="../../js/FB.js"></script>
		<script src="../check-rank.js"></script>
		<style>
			a{color: black;}
			ol{margin-left: 50px;}
			.min{
				width: 1px;
				height: 1px;
				white-space:nowrap;
				text-align: center;
			}
			table{
				counter-reset: section;
			}
			table tr td:first-child:before{
				counter-increment: section;
				content: counter(section);
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							<button type="button" id="getListMembers" class="btn btn-primary">Lấy danh sách thành viên</button>
							<button type="button" id="getRankMembers" class="btn btn-primary">Thống kê tương tác</button>
							<button type="button" id="test" class="btn btn-primary">Test</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Danh sách thành viên</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="min"></th>
										<th>Username</th>
										<th class="min">Id</th>
										<th class="min" sort="3">Post</th>
										<th class="min" sort="4">Like</th>
										<th class="min" sort="5">Comment</th>
										<th class="min" sort="6">Has like</th>
										<th class="min" sort="7">Has comment</th>
									</tr>
								</thead>
								<tbody id="listMenbers">
									<!-- <tr>
										<td></td>
										<td>Socola Đại Ca</td>
										<td>100006907028797</td>
										<td>1</td>
										<td>2</td>
										<td>1</td>
										<td>2</td>
										<td>1</td>
									</tr>
									<tr>
										<td></td>
										<td>Socola Đại Ca</td>
										<td>100006907028797</td>
										<td>2</td>
										<td>1</td>
										<td>2</td>
										<td>1</td>
										<td>2</td>
									</tr> -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Danh sách bài viết</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th></th>
										<th>List posts</th>
									</tr>
								</thead>
								<tbody id="listPosts">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>