<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Delete all posts in wall</title>
	<?php require_once '../../Views/layout/header.php'; ?>
	<?php require_once '../../Views/layout/css.php'; ?>
</head>
<body id="app">
	<?php require_once '../../Views/layout/nav.php'; ?>
	<div class="container text-center">
		<h1>Delete all posts in wall</h1>
		<p>Xóa toàn bộ bài viết trên tường của bạn</p>
		<button type="button" class="btn btn-primary btn-lg" v-on:click="start">Bắt đầu</button>
	</div>
	<?php require_once '../../Views/layout/js.php'; ?>
	<script src="delete-all-posts-in-wall.js"></script>
</body>
</html>