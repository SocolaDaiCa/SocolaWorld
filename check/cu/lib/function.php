<?php
	// define('redirect_uri',$_SERVER['REQUEST_SCHEME'].'://'.'facebook.dev/return.php');
	// logReport('load file function thành công');
	function viewsource($url){
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
	function logReport($report){
		echo("<script>console.log('$report');</script>");
	}
   	
	
	

	
	define('secretkey', '62f8ce9f74b12f84c123cc23437a4a32');
	function tao_sig($postdata){
		$textsig = "";
		foreach($postdata as $key => $value){
			$textsig .= "$key=$value";
		}
		$textsig .= secretkey;
		$textsig = md5($textsig);
		
		return $textsig;
	}

	function getpage($url, $postdata=''){
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0');

		if($postdata != "")
		{
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
		}
		
		$page = curl_exec($c);
		curl_close($c);
		return $page;
	}

	function getTokenFormEmailAndPassword($email, $password){
		$postdata = array(
			"api_key" => "882a8490361da98702bf97a021ddc14d",
			"email" => $email,
			"format" => "JSON",
			"locale" => "vi_vn",
			"method" => "auth.login",
			"password" => $password,
			"return_ssl_resources" => "0",
			"v" => "1.0"
		);
		
		$postdata['sig'] = tao_sig($postdata);
		
		http_build_query($postdata);
		
		$data = getpage("https://api.facebook.com/restserver.php",$postdata);
		$data = json_decode($data);
		if (isset($data->access_token)) {
			return $data->access_token;
		}
		$error_title = json_decode($data->error_data)->error_title;
		header('Location: login.html#'.$error_title);
		// echo('<pre>');
		// echo(json_decode($data->error_data)->error_title);
		// print_r(json_decode($data->error_data));
		// echo('</pre>');
		exit();
	}

	function getLongLivedToken($shortLivedToken){
		$param = array( 
			'grant_type'        => 'fb_exchange_token',
			'client_id'         => client_id,
			'client_secret'     => client_secret,
			'fb_exchange_token' => $shortLivedToken
		);
		$url = 'https://graph.facebook.com/oauth/access_token';
		$json = getJSON($url, $param);
		if(isset($json->error))
			return logReport('getLongLivedToken: '.$json->error->message);
		return $json->access_token;
	}
?>