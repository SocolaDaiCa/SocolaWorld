<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>test popup</title>
	<?php require_once '../layout/css.php'; ?>
</head>
<body>

	<?php require_once '../layout/js.php'; ?>
</body>
</html>
<script>
	'use strict';
	$(function() {
		window.open("http://google.com", "myWindow", 'width=800,height=600');
	});
</script>