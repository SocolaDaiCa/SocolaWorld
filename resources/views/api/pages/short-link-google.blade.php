<?php
	function isURL($url)
	{
		return filter_var($url, FILTER_VALIDATE_URL);
	}
	$url = $_GET['url'] ?? '';
	if (!isURL($url)) {
		die('This is not url');
	}

	$apiKey  = 'AIzaSyCgz2SsFFb3vqxZ2VyuXIDk_qnIH00hBUc';
		 
	$postData = array('longUrl' => $url);
	$jsonData = json_encode($postData);
		 
	$curlObj = curl_init();
		 
	curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	curl_setopt($curlObj, CURLOPT_POST, 1);
	curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		 
	$reply = curl_exec($curlObj);
		 
	$json = json_decode($reply);
		 
	curl_close($curlObj);
		
	if(isset($json->error)){
		echo $json->error->message;
	}else{
		$short_url = $json->id;
		echo($short_url);
	}
?>