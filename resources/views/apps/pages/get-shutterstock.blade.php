<?php
	function curl($url){
		$ch	  = curl_init();
		$timeout = 15;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.69 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	// $origin = $_REQUEST['url'];
	$origin = 'https://www.shutterstock.com/image-photo/sexy-beautiful-brunette-woman-lying-bed-276435800';
	$token = 'EAAI4BG12pyIBAA4RVnCZBvbBut2ew4zzZCxpJ6XzZBZCQsKMwwICP8c8awBXIJzBso2iIfwKKMPOcK88g5rwqkBIRnPI6ngUvTW9seZCk7bLMxdPKnNIpt3pnS42knLW8UHw1FuwWGmpbQHehWXM70rAO0D7l5gZC1PpzxbeZAzoa2FJqHjYXYZCi4wlPwZAhkEj3NdFdZBmTobZBGZAhWUQe1ZCt';
	$pattern ='/https?:\/\/(www\.)?shutterstock\.com\/([a-z]{2}\/)?image-(photo|vector|illustration)\/[a-zA-Z0-9-]+-([0-9]+)/';
	$regex = preg_match($pattern, $origin, $matches);
	$url = "https://graph.facebook.com/v2.8/ssimg_".$matches[4]."?fields=preview_url&access_token=".$token;
	$json_string = curl($url);
	$json = json_decode($json_string,true);
	if(isset($json['error']))
	{?>
	<div class="warning">
		<b>Thông báo!</b> Lỗi rồi.
	</div>
	<?php
		exit();
	}
	// $url = $json['preview_url'];
	// $urlArr = explode('&url=', $url);
	// $url = $urlArr[1];
	// $url = urldecode($url);
?>
	Click on image to download
	<a href="<?php echo $url; ?>" class="btn btn-default" title="" target="_blank">View full image</a>
	<a href="<?php echo $url ?>" title="" download>
		<img src="<?php echo $url ?>" alt="">
	</a>


<?php require_once __DIR__ . '/../../Views/layout/check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Get link Shutterstock</title>
		<?php require_once '../../Views/layout/header.php'; ?>
		<?php require_once '../../Views/layout/css.php'; ?>
	</head>
	<body>
		<?php require_once '../../Views/layout/nav.php'; ?>
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
	<?php require_once '../../Views/layout/js.php'; ?>
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