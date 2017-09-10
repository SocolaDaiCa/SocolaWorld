<?php require_once '../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Encode - Decode</title>
		<?php require_once '../../layout/header.php'; ?>
		<!-- Latest compiled and minified CSS & JS -->
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" href="css/encode-decode.css">
	</head>
	<body>
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<label for="">Input</label>
					<textarea name="" id="input" class="form-control" rows="15" required="required"></textarea>
				</div>
				<div class="col-lg-6">
					<label for="">Output</label>
					<textarea name="" id="output" class="form-control" rows="15" required="required"></textarea>
				</div>
			</div>
			<div class="row action">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<button name="urldecode" class="btn btn-primary">Url decode</button>
						<button name="urlencode" class="btn btn-primary">Url encode</button>
					</div>
					<div class="form-group">
						<button name="base64_decode" class="btn btn-primary">Base64 decode</button>
						<button name="base64_encode" class="btn btn-primary">Base64 encode</button>
					</div>
					<div class="form-group">
						<button name="md5" class="btn btn-primary">md5</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php require_once '../../layout/js.php'; ?>
<script>
	'use strict';
	$(function() {
		$('button').click(function() {
			var input = $('#input').val();
			var action = $(this).attr('name');
			$.get('action.php', {
				action:  action,
				value : input
			}, function(res) {
				$('#output').val(res);
			});
		});
	});
</script>