<?php
	require_once '../db/connect.php';
	class CkeckHashTag
	{
		private $token = '';
		private $endPoint = 'https://graph.facebook.com';
		private $message = "";
		private $groupId = '677222392439615';
		private $listHashTag = array(
			'#sfit_news',
			'#sfit_question',
			'#sfit_discussion',
			'#sfit_share',
			'#sfit_relax',
			'#sfit_suggest',
			'#sfit_job'
		);
		function __construct()
		{
			$this->message = urlencode("Bổ sung hashtag nhé \n https://sfit-utc.tentstudy.xyz/hashtags.html");
		}
		public function setToken($token)
		{
			$this->token = $token;
		}
		public function setGroupId($groupId)
		{
			$this->groupId = $groupId;
		}
		public function start()
		{
			global $db;
			$listPosts = $this->getListPost();
			if (sizeof($listPosts) == 0) {
				// echo('không có bài nào cả');
				return;
			}
			foreach ($listPosts as $post) {
				if($this->checkHashtag($post)){
					return;
				}
				if($db->checkRemindHashTag($post->id)){
					// echo("đã từng được nhắc từ trước <a href=\"//fb.com/$post->id\" target=\"_blank\">$post->id</a><br>");
				} else {
					$this->remindHashTag($post->id);
					// echo("thiếu hashtag {$post->id}<br>");
					$db->saveRemindHashTag($post->id);
				}
			}
		}
		public function checkHashtag($post)
		{
			if(empty($post->message)){
				return false;
			}
			$message = strtolower($post->message);
			foreach ($this->listHashTag as $hashTag) {
				if(strpos($message, $hashTag) !== false){
					return true;
				}
			}
			return false;
		}
		public function getListPost()
		{
			$query = "{$this->endPoint}/{$this->groupId}/?fields=feed.since(-1+minutes).limit(200){message,from}&access_token={$this->token}";
			// echo($query);
			$jsonString = file_get_contents($query);
			$json = json_decode($jsonString);
			if(isset($json->feed->data)){
				return $json->feed->data;
			} else {
				return array();
			}
		}
		public function remindHashTag($postId)
		{
			file_get_contents("{$this->endPoint}/{$postId}/comments?method=post&access_token={$this->token}&message={$this->message}");
		}
	}
	/*enc class*/
	$bot = new CkeckHashTag();
	$bot->setGroupId($_GET['g'] ?? '677222392439615');
	$bot->setToken($_GET['token'] ?? 'EAACW5Fg5N2IBALiugMZAazZAjYd2ysGoWPRzUPRogzL9cA8M9jSf2kWv7ny8hXdzB9sAav8NhceLkSm4jhcoUpIdIyK3k2KjqZBR3RuvwmoD7S6ZAaiqNQj4XdhOhjnZClTY5NPmuD1h0BgjgedAdljKsUJ5ZAI0NPZClknAlZBXZBNEtQU6T3B31');
	/*EAACW5Fg5N2IBAH2v5cZBc4iKQbSDBsZAoDAbAFQBhBPXJOjIfdw599kCk0C2GsCJlSMBoPAJKkZBzPLFIyF3CFYZBwrLeOwdgPBt2uigZCAJLioSaDkgS3ZBS0PH9366qNz575AWcK3jy31UpB8d2qwU6gfNotn3XD4Ut0jjAzYQZDZD*/
	
	set_time_limit(0);
	$start = strtotime("now");
	// while (strtotime("now") - $start < 60) {
		$bot->start();
	// }
?>