<?php require_once '../../Views/layout/check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Giveway Checker</title>
		<?php require_once '../../Views/layout/header.php'; ?>
		<?php require_once '../../Views/layout/css.php'; ?>
		<link rel="stylesheet" href="giveway-checker.css">
	</head>
	<body id="app">
		<?php require_once '../../Views/layout/nav.php'; ?>
		<div class="container">
			<!-- input form -->
			<div style="max-width: 600px; margin: auto">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">ID bài viết</span>
						<input type="text" v-model="idStatus" class="form-control" placeholder="Id status">
						<span class="input-group-btn">
							<button v-on:click="filterComments" class="btn btn-secondary" type="button">Filter!</button>
						</span>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th></th>
						<th>UserName</th>
						<th>Message</th>
						<th>Share</th>
						<th>Tag</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(index, comment) in listComments">
						<td>{{index +1}}</td>
						<td><a href="//fb.com/{{messsage.from.id}}" target="_blank">{{comment.from.name}}</a></td>
						<td>{{comment.message}} <a href="//fb.com/{{comment.id.sp}}" target="_blank">view</a></td>
						<td></td>
						<td>{{comment.message_tags.length}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php require_once '../../Views/layout/js.php'; ?>
		<script src="giveway-checker.js"></script>
	</body>
</html>