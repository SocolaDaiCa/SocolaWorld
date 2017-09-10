<?php require_once '../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Get link Shutterstock</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
	</head>
	<body>
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<div class="page-header text-center">
				<h1>Get link Shutterstock</h1>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group-lg">
						<div class="input-group" style="max-width: 650px; margin: 0 auto;">
							<input type="text" name="" id="url" class="form-control" value="https://www.shutterstock.com/image-illustration/anime-girl-587949341" required="required" pattern="" title="" placeholder="Link shutterstock">
							<span class="input-group-btn">
								<button class="btn btn-secondary btn-lg" id="get-image" type="button">Get image</button>
							</span>
						</div>
					</div>
				</div></div>
				<div id="result" class="col-md-9 col-lg-9">
				</div>
			</div>
		</body>
	</html>
	<?php require_once '../../layout/js.php'; ?>
	<script>
		'use strict';
		$(function() {
			$("#get-image").click(function() {
				var url = "get-link-Shutterstock.php";
				var data = {url: $("#url").val()};
				console.log(data.url);
				$.get(url, data, function(res) {
					$("#result").html(res);
						// 	// $("#result").children("a").attr("href", res);
						// 	// $("#result").children("a").children("img").attr("src",res);
						// 	// $("#result").show();
				});
			});
		});
	</script>