<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Controller.php';
	require_once __DIR__ . '/../Model/Model_Girl.php';
	class Controller_Girl extends Controller
	{
		protected $fb;
		protected $m;
		function __construct($token)
		{
			parent::__construct();
			$this->m = new Model_Girl;
			$this->fb = new Graph($token);
			if(!$this->fb->isTokenLive()) die("Token Die");
		}
		public function crawl($groupID)
		{
			echo $groupID . "<br>";
			$json = $this->fb->graph($groupID, array(
				"fields" => "feed.limit(25).since(-1 hour){attachments{media,target}}"
			))->feed;

			foreach ($json->data as $post) {
				foreach ($this->getSrc($post) as $target => $src) {
					$this->m->addImage($target, $src);	
				}	
			}
			
			while(!empty($json->paging->next)){
				$json = getJSON($json->paging->next);
				foreach ($json->data as $post) {
					foreach ($this->getSrc($post) as $target => $src) {
						$this->m->addImage($target, $src);
						echo "<img src=\"$src\" alt=\"\">";
					}	
				}
			}
		}
		public function getSrc($post)
		{
			$srcs  = array();
			if(empty($post->attachments->data)) return $srcs;
			foreach ($post->attachments->data as $data) {
				if(!empty($data->media->image->src))
					$srcs[$data->target->id] = $data->media->image->src;
			}
			return $srcs;
		}
	}
?>