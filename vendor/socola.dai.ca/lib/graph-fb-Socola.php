<?php
	/**
	* 
	*/
	require_once __DIR__ . '/curl.php';
	/**
	* 
	*/
	class Graph
	{
		protected $token = "";
		protected $endPoint = "https://graph.facebook.com/v2.11/";
		function __construct($token = ""){
			$this->setToken($token);
		}

		public function setToken($token){
			$this->token = empty($token) ? $this->token : $token;
		}

		public function graph($target, $param = array()){
			$param["access_token"] = $this->token;
			return getJSON($this->endPoint . $target, $param);
		}

		public function isTokenLive($token = "")
		{
			$this->setToken($token);
			$this->json = $this->graph("me", ['fields' => 'name,id']);
			return empty($this->json->error);
		}
		function codeToToken($code, $clienID, $redirectUri, $clientSecret){
			$param = array(
				'client_id'     => $clienID,
				'redirect_uri'  => $redirectUri,
				'client_secret' => $clientSecret,
				'code'          => $code,
			);
			$url  = 'https://graph.facebook.com/v2.3/oauth/access_token';
			$json = getJSON($url, $param);
			if(isset($json->error)){
				print_r($json->error);
				exit();
			}
			return $json->access_token;
		}
		/* get token Full permission*/
		public function tao_sig($postdata, $secretkey){
			$textsig = "";
			foreach($postdata as $key => $value){
				$textsig .= "$key=$value";
			}
			// $textsig .= $secretkey;
			echo $textsig . "<br>";
			
			echo $textsig;
			// $textsig = md5($textsig);
			// return $textsig;
			return "";
		}
		public static function getToken($email, $password, $type = 'iosforpage'){
			$key = [
				'android' => [
					'api_key' => '882a8490361da98702bf97a021ddc14d',
					'secretkey' => '62f8ce9f74b12f84c123cc23437a4a32'
				],
				'iphone' => [
					'api_key' => '3e7c78e35a76a9299309885393b02d97',
					'secretkey' => 'c1e620fa708a1d5696fb991c1bde5662'
				],
				'iosforpage' => [
					'api_key' => '',
					'secretkey' => ''
				]
			];

			$api_key = $key[$type]['api_key'];
			$secretkey = $key[$type]['secretkey'];
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

			// tạo chuỗi kết nối
			$postdata['sig'] = http_build_query($postdata, '', '') . $secretkey;
			$postdata['sig'] = md5(urldecode($postdata['sig']));
			http_build_query($postdata);
			
			$data = cUrlPost("https://api.facebook.com/restserver.php", $postdata);
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
		public function getInfoUser()
		{
			return array(
				'id' => $this->json->id,
				'name' => $this->json->name
			);
		}
	}
	class GraphFacebook
	{
		private $token;
		private $json;
		private $endPoint = "https://graph.facebook.com/";
		function __construct($token = "")
		{
			$this->token = $token;
		}
		public function loginWithFacebook($permission, $clienID, $redirectUri){
			$url = 'https://www.facebook.com/dialog/oauth';
			$scope = array();
			foreach ($permission as $key => $value) {
				if($value){
					$scope[] = $key;
				}
			}
			$scope = implode($scope, ',');
			$param = array(
				'client_id' => $clienID,
				'redirect_uri' => $redirectUri,
				'scope' => $scope,
			);
			header('Location: ' . getUrl($url, $param));
		}
	}
	// default
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
		'manage_pages'                   => 1,
		'publish_pages'                  => 0,
		'pages_show_list'                => 0,
		'pages_manage_cta'               => 0,
		'pages_manage_instant_articles'  => 0,
		'pages_messaging'                => 0,
		'pages_messaging_subscriptions'  => 0,
		'pages_messaging_payments'       => 0,
		'pages_messaging_phone_number'   => 0
	);
?>