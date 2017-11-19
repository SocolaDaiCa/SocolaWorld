<?php
	/**
	* 
	*/
	function cURL($url){
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
	function getUrl($url, $param)
	{
		return $url . "?" . http_build_query($param);
	}
	function getJSON($url, $param)
	{
		return json_decode(cURL(getUrl($url, $param)));
	}
	interface GraphFacebookInterface
	{
		public function isTokenLive($token);
		public function getInfoUser();
	}
	class GraphFacebook implements GraphFacebookInterface
	{
		private $token;
		private $json;
		private $endPoint = "https://graph.facebook.com/";
		function __construct($token = "")
		{
			$this->token = $token;
		}
		public function isTokenLive($token)
		{
			$this->json = getJSON($this->endPoint . "me",array(
				'access_token' => $token,
				'fields' => 'name,id'
			));
			return empty($this->json->error);
		}
		public function getInfoUser()
		{
			return array(
				'id' => $this->json->id,
				'name' => $this->json->name
			);
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
		function getTokenFromCode($code, $clienID, $redirectUri, $clientSecret){
			$param = array(
				'client_id'     => $clienID,
				'redirect_uri'  => $redirectUri,
				'client_secret' => $clientSecret,
				'code'          => $code,
			);
			$url  = 'https://graph.facebook.com/v2.3/oauth/access_token';
			// $json = file
			$json = getJSON($url, $param);
			// print_r($json);
			// return $json;
			if(isset($json->error))
			{
				die(logReport('getTokenFromCode: '.$json->error));
			}
			return $json->access_token;
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