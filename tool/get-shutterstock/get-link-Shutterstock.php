<?php 
	$origin = $_REQUEST['url'];
	$token = 'EAAI4BG12pyIBALN97aXxEu9ftZAVPEsWZBWZB93lWhuIZBg1JF1kWlFolgCBhKOfIgwej6Y73zB5zBm5355wnHGQHheq3ofq3h9kVb2MpErQuNCZATbjLW7zBOxKHJQhoRBtBmeVGIwoPx7wjEDxILhIfC74lwQZB93pP6JIZBtyRjP9IoE8d0khPCOFvKZBzIa13z3MSaA5Mchpx40AwCfv';
	$pattern ='/https?:\/\/(www\.)?shutterstock\.com\/([a-z]{2}\/)?image-(photo|vector|illustration)\/[a-zA-Z0-9-]+-([0-9]+)/';
	$regex = preg_match($pattern, $origin, $matches);
	$url = "https://graph.facebook.com/v2.8/ssimg_".$matches[4]."?fields=preview_url&access_token=".$token;
	$json = file_get_contents($url);
	$json = json_decode ($json,true);
	$url = $json['preview_url'];
	$urlArr = explode('&url=', $url);
	$url = $urlArr[1];
	echo(urldecode($url));
?>