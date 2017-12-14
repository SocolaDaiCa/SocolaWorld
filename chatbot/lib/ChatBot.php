<?php
	/**
	* 
	*/
	require_once __DIR__ . 'SDK-Php-Chatfuel-Socola.php';
	class ChatBot extends 
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function getVoice($text)
		{
			$url  = 'http://translate.google.com/translate_tts?ie=UTF-8&total=1&idx=0&textlen=text.length&tl=vi&client=tw-ob&q=' . urlencode($text);
			return $url;
		}
	}
?>