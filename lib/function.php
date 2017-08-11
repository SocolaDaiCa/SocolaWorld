<?php
	define('client_id','425249171186475');
	define('client_secret','1723fe0ec79cd0cf142c93b9010ff5d8');
	// define('redirect_uri',$_SERVER['REQUEST_SCHEME'].'://'.'facebook.dev/return.php');
	define('redirect_uri','http://facebook.dev/return.php');

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
   	function getUrl($url, $param =null){	
		if ($param==null)
			return $url;
		return $url.'?'.http_build_query($param);
	}
	function getJSON($url, $param =null){
		logReport(getUrl($url, $param));
		return json_decode(viewsource(getUrl($url, $param)));
	}
	function loginWithFacebook(){
		$url = 'https://www.facebook.com/dialog/oauth';
		$permission = array(
			/*public*/
				'public_profile'                 => 1,
				'user_friends'                   => 1,
				'email'                          => 1,
			/*user*/
				'user_about_me'                  => 0,
				'user_actions.books'             => 0,
				'user_actions.fitness'           => 0,
				'user_actions.music'             => 0,
				'user_actions.news'              => 0,
				'user_actions.video'             => 0,
				'user_actions:{app_namespace}'   => 0,
				'user_birthday'                  => 0,
				'user_education_history'         => 0,
				'user_events'                    => 0,
				'user_games_activity'            => 0,
				'user_hometown'                  => 0,
				'user_likes'                     => 0,
				'user_location'                  => 0,
				'user_managed_groups'            => 1,
				'user_photos'                    => 0,
				'user_posts'                     => 0,
				'user_relationships'             => 0,
				'user_relationship_details'      => 0,
				'user_religion_politics'         => 0,
				'user_tagged_places'             => 0,
				'user_videos'                    => 0,
				'user_website'                   => 0,
				'user_work_history'              => 0,
			/*read*/
				'read_custom_friendlists'        => 0,
				'read_insights'                  => 0,
				'read_audience_network_insights' => 0,
				'read_page_mailboxes'            => 0,

				'publish_actions'                => 0,
				'rsvp_event'                     => 0,
				'ads_read'                       => 0,
				'ads_management'                 => 0,
				'business_management'            => 0,
			/*page*/
				'manage_pages'                   => 0,
				'publish_pages'                  => 0,
				'pages_show_list'                => 0,
				'pages_manage_cta'               => 0,
				'pages_manage_instant_articles'  => 0,
				'pages_messaging'                => 0,
				'pages_messaging_subscriptions'  => 0,
				'pages_messaging_payments'       => 0,
				'pages_messaging_phone_number'   => 0
		);
		$scope = array();
		foreach ($permission as $key => $value) {
			if($value){
				$scope[] = $key;
			}
		}
		$scope = implode($scope, ',');
		$param = array(
			'client_id' => client_id,
			'redirect_uri' => redirect_uri,
			'scope' => $scope,
		);
		header('Location: '.getUrl($url, $param));
	}

	function getTokenFromCode(){
		$param = array(
			'client_id'     => client_id,
			'redirect_uri'  => redirect_uri,
			'client_secret' => client_secret,
			'code'          => $_GET['code'],
		);
		$url  = 'https://graph.facebook.com/v2.3/oauth/access_token';
		$json = getJSON($url, $param);
		if(isset($json->error))
		{
			logReport('getTokenFromCode: '.$json->error);
			exit();
		}
		return $json->access_token;
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