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
	$origin = $_REQUEST['url'];
	$token = 'EAAI4BG12pyIBAEKphZBF0u6x01NhKdOOZAsohezZA5s3XBbxeww7WvazbqWcb3NSK9722nqCbycjHJbED5sfOl1ZCu66CGSoZCIWHVKckqYZAZCkKl0Gxk669GBKLodN6c1dOhD0dCOsftzSnqVqE1bt3x8Q5NIhwu4Jew5tROSePIoGGq7pTb9wphrYMG8ciwCSCk8EOZAt5qs1IQI2xEZB9';
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
	$url = $json['preview_url'];
	$urlArr = explode('&url=', $url);
	$url = $urlArr[1];
	$url = urldecode($url);
?>
	Click on image to download
	<a href="<?php echo $url; ?>" class="btn btn-default" title="" target="_blank">View full image</a>
	<a href="<?php echo $url ?>" title="" download>
		<img src="<?php echo $url ?>" alt="">
	</a>