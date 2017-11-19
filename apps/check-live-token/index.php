<?php require_once '../../Views/layout/check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Check live Token</title>
		<?php require_once '../../Views/layout/header.php'; ?>
		<?php require_once '../../Views/layout/css.php'; ?>
		<link rel="stylesheet" href="css/check-live-token.css">
	</head>
	<body>
		<?php require_once '../../Views/layout/nav.php'; ?>
		<div class="container">
			<div class="text-center">
				<h1>Check live Token</h1>
			</div>
			<div class="form-group">
				<span>Nhập danh sách token, mỗi token nằm trên 1 dòng</span>
				<textarea id="token-input" class="form-control" rows="10" required="required"></textarea>
			</div>
			<div class="form-group">
				<button id="start-check" class="btn btn-primary">Check token</button>
				<button id="clear-result" class="btn btn-default">
				<i class="fa fa-recycle"></i> Clear result</button>
				<button id="unique" class="btn btn-default">Unique</button>
				<button type="button" class="btn btn-default" data-clipboard-action="copy" data-clipboard-target="#token-input">
				<i class="fa fa-copy"></i> Copy to clipboard</button>
				<button type="button" class="btn btn-default" data-clipboard-action="cut" data-clipboard-target="#token-input">
				<i class="fa fa-cut"></i> Cut to clipboard</button>
			</div>
			<span id="countToken"></span> <span id="result"></span>
			<p>Result</p>
			<ol id="result-live" class="bg-success">

			</ol>
			<div id="result-die" class="bg-danger"></div>
		</div>
		<script src="../../vendor/jquery/jquery.min.js"></script>
		<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="js/check-live-token.js"></script>
		<script src="../../vendor/clipboard/clipboard.min.js"></script>
		<script>
			'use strict';
			var clipboard = new Clipboard('.btn');
			clipboard.on('success', function(e) {
				console.log(e);
			});
			clipboard.on('error', function(e) {
				console.log(e);
			});
		</script>
	</body>
</html>