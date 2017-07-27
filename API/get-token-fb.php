<?php
/* dev by Socola Đại Ca
 * fb.com/SocolaDaiCa1997
 */
	function tao_sig($postdata, $secretkey){
		$textsig = "";
		foreach($postdata as $key => $value){
			$textsig .= "$key=$value";
		}
		$textsig .= $secretkey;
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

	function getTokenFormEmailAndPassword($email, $password, $api_key, $secretkey){
		$postdata = array(
			"api_key" => $api_key,
			"email" => $email,
			"format" => "JSON",
			"locale" => "vi_vn",
			"method" => "auth.login",
			"password" => $password,
			"return_ssl_resources" => "0",
			"v" => "1.0"
		);
		
		$postdata['sig'] = tao_sig($postdata, $secretkey);
		
		http_build_query($postdata);
		
		$data = getpage("https://api.facebook.com/restserver.php",$postdata);
		$data = json_decode($data);
		if (isset($data->access_token)) {
			return $data->access_token;
		}
		$error_title = json_decode($data->error_data)->error_title;
		return $data;
		// header('Location: login.html#'.$error_title);
		// echo('<pre>');
		// echo(json_decode($data->error_data)->error_title);
		// print_r(json_decode($data->error_data));
		// echo('</pre>');
	}

	[
		'u' => $username,
		'p' => $password,
		't' => $type
	] = $_GET;

	$types = array(
		'android',
		'iphone',
		'iosforpage'
	);

	switch ($type) { // mặc định là iosforpage
		case 'android':
			$api_key   = '882a8490361da98702bf97a021ddc14d';
			$secretkey = '62f8ce9f74b12f84c123cc23437a4a32';
			break;
		case 'iphone':
			$api_key   = '3e7c78e35a76a9299309885393b02d97';
			$secretkey = 'c1e620fa708a1d5696fb991c1bde5662';
			break;
		default: // iosforpage
			$api_key   = '';
			$secretkey = '';
			break;
	}
	echo getTokenFormEmailAndPassword($username, $password, $api_key, $secretkey);
?>