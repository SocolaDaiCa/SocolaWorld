<pre>
<?php 
	require_once '../db/connect.php';
	class RemindHashTag
	{
		private $token;
		private $endPoint = 'https://graph.facebook.com';
		function __construct()
		{
			
		}
		public function start()
		{
			global $db;
			// get list bot
			$listBots = $db->query("SELECT group_id,access_token,hashtag,messages from bot_remind_hashtag where active=1 and hashtag!='' and messages!=''");
			// print_r($listBots);
			foreach ($listBots as $bot) {
				// get data per bot
				$groupId = $bot[0];
				$token = $bot[1];
				$listHashTags = explode(",", $bot[2]);
				// var_dump($listHashTags);
				$listMessages = explode(";", $bot[3]);
				// chạy từng con bot
				$listPosts = $this->getListPost($groupId, $token);
				foreach ($listPosts as $post) {
					// print_r($post);
					if((empty($post->message) || !$this->hasHashTag($post->message, $listHashTags)) && !$db->hadRemindHashTag($post->id)){
						echo('không có hashtag');
						$this->remindHashTag($post->id, $listMessages[array_rand($listMessages, 1)], $token);
						$db->saveRemindHashTag($post->id);
					}
				}
			}
		}
		public function getListPost($groupId, $token)
		{
			$query = "{$this->endPoint}/{$groupId}/?fields=feed.since(-10+minutes).limit(200){message,from}&access_token={$token}";
			$jsonString = file_get_contents($query);
			$json = json_decode($jsonString);
			if(isset($json->feed->data)){
				return $json->feed->data;
			} else {
				return array();
			}
		}
		public function hasHashTag($message, $listHashTags)
		{
			$message = strtolower($message);
			foreach ($listHashTags as $hashTag) {
				if(strpos($hashTag, $message) !== false){
					return true;
				}
			}
			return false;
		}
		public function remindHashTag($postId, $message, $token)
		{
			$message = urlencode($message);
			echo("{$this->endPoint}/{$postId}/comments?method=post&access_token={$token}&message={$message}");
			file_get_contents("{$this->endPoint}/{$postId}/comments?method=post&access_token={$token}&message={$message}");
			echo('end remind');
		}
	}
	$bot = new RemindHashTag();
	$bot->start();
?>