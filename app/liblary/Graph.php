<?php
	namespace App\Liblary;
	require_once __DIR__ . '/curl.php';
	class Graph
	{
		protected $token = "";
		protected $endPoint = "https://graph.facebook.com/v2.9/";
		function __construct($token = ''){
			if(empty($token))
				$token = 'EAACW5Fg5N2IBACyBRPDt81h3xAlUP65W8L4esDSNCyLjUIqzHhAGhp26SEMrnBlg8FiiJCL8tJTYdo3PZCWwLahWde8hb0OATxPGy1WeGZAdR3BBdh8hsOJZA9Ed6C0sj9JF2yKsSXEZANDeWSQZC7dTxA0qFUNcD9lBsmMs7CIIZBt2LZAu2mqDtfJWZA1yZClMZD';
			$this->setToken($token);
		}
		/* set token */
		public function setToken($token){
			$this->token = empty($token) ? $this->token : $token;
		}
		/* graph */
		public function graph($target, $param = [], $callback = null, $field = ''){
			$param["access_token"] = $this->token;
			$res = getJSON($this->endPoint . $target, $param);
			if(empty($callback) || empty($field)){
				return $res;
			}
			if(empty($res->$field->data)) return [];

			$callback($res->$field->data);
			$res = $res->$field;
			while(!empty($res->paging->next)){
				$res = getJSON($res->paging->next);
				if(empty($res->data)) continue;
				$callback($res->data);
			}
		}
		/* is token live */
		public function isTokenLive($token = "")
		{
			$this->setToken($token);
			$this->json = $this->graph("me", ['fields' => 'name,id']);
			return empty($this->json->error);
		}

		function codeToToken($code, $clienID = CLIENT_ID, $redirectUri = REDIRECT_URI, $clientSecret = CLIENT_SECRET){
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
		public static function getToken($email, $password, $type = 'android'){
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
			return $data;
			// if (isset($data->access_token)) {
			// 	return $data->access_token;
			// }
			// $error_title = json_decode($data->error_data)->error_title;
			// return $error_title;
		}
		public function login($permission = [], $clienID = '', $redirectUri){
			$scope = [];
			foreach ($permission as $key => $value) {
				if($value){
					$scope[] = $key;
				}
			}
			$scope = implode($scope, ',');
			$param = [
				'client_id' => $clienID,
				'redirect_uri' => $redirectUri,
				'scope' => $scope,
			];
			$url = 'https://www.facebook.com/dialog/oauth';
			header('Location: ' . getUrl($url, $param));
		}
	}
	// default
	define('CLIENT_ID', '');
	define('REDIREC_URI', 'https://');
	define('CLIENT_SECRET', '');
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