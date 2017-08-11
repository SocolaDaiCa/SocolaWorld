<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Get link</title>
		<?php require_once '../../layout/blocks/header-for-all-page.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../css/socola.css">
		<style>
			img{
				max-width: 100%;
			}
			/*#result{
				display: none;
			}*/
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Get link Shutterstock</h1>
				<!-- title<small>subtext</small> -->
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="" id="url" class="form-control" value="" required="required" pattern="" title="" placeholder="Link shutterstock">
						<span class="input-group-btn">
							<button class="btn btn-secondary" id="get-image" type="button">Get image</button>
						</span>
					</div>
				</div>
			</div>
			<div id="result" class="col-md-9 col-lg-9">
			</div>
		</div>
		<?php require '../../layout/blocks/footer-for-all-page.php'; ?>
	</body>
</html>
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