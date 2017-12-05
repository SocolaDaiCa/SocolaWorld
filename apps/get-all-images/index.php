<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Get All Image</title>
	<?php require_once __DIR__ . '/../../Views/layout/css.php'; ?>
</head>
<body>
	<div class="container" id="app">
		Token
		<input type="text" v-model="token" class="form-control">
		User ID
		<input type="text" v-model="userID" class="form-control">
		<br>
		<button type="button" v-on:click="get" class="btn btn-default">button</button>
		<!-- <textarea v-model="listLink" style="width: 100%;" rows="10"></textarea> -->
		<ol>
			<li v-for="item in listLink">{{item}}</li>
		</ol>
	</div>
	<?php require_once __DIR__ . '/../../Views/layout/js.php'; ?>
	<script src="script.js"></script>

</body>
</html>