<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Socola-php-function.php';
	class SocolaGraphFacebook
	{
		private $json;
		public $graph = 'https://graph.facebook.com/';
		function __construct()
		{
			
		}
		public function isTokenLive($token)
		{
			$this->json = getJSON($this->graph . "me",array(
				'access_token' => $token,
				'fields' => 'name,id'
			));

			return true;
		}
		public function getInfoUser()
		{
			return array(
				'id' => $this->json->id,
				'name' => $this->json->name
			);
		}
	}
?>