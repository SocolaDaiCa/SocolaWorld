<?php
interface FB_interface{
	function __construct();
	function setAccess_token($access_token);
	function checkToken();
	function set_cover($id);
	function show_avatar($post);
	function show_story($value);
	function getPathShowError();
	function setData();
	function graph($id, $fields='', $version='');
	function graph_all($id, $fields, $data_name, $limit, $version='');
	function show_creat_time(&$value);
	function show_message($value, $Keo);
	function show_source($value);
	function show_full_picture(&$value);
	function body_post(&$value);
	function show_link_graph();
	function find_id($link);
	function post_comment($id_post, $text);
	function menu();
	function show_post($value);
	function showError();
}
class FB implements FB_interface{
	public $Keo= array("\n", ' ', "[", "]", ',', '"');
	public $link;
	public $access_token='';
	public $graph = 'https://graph.facebook.com/';
	public $path_show_error;
	public $json;
	public $json_string;
	/**/
	public $id = 'me';
	public $name = '';
	/**/
	function __construct($path='./'){
		$this->path_show_error= $path.'login.html';
	}
	public function setToken($token){
		$this->access_token = $token;
	}
	public function checkToken(){
		$param = array(
			'fields' => 'id,name',
			'access_token' => $this->access_token
		);
		$this->json = getJSON($this->graph.'me', $param);
		return empty($this->json->error);
	}
	/* đã kiểm duyệt */
	function setAccess_token($access_token){
		$this->access_token = $access_token;
	}
	
	function set_cover($id){
		$json_cover = $this->graph($id, 'cover');
		if(!isset($json_cover->cover->source))	return;
		$url_cover = $json_cover->cover->source;
		echo ('<style type="text/css">.cover{background-image: url("'.$url_cover.'");}</style>');
	}
	function show_avatar($post){
		$id = $post->from->id;
		$link_profile = "https://fb.com/{$id}";
		$link_avatar = "https://graph.facebook.com/{$id}/picture?type=large&redirect=true&width=40&height=40";
		echo('<a href="'.$link_profile.'" title="" target="_blank"><img src="'.$link_avatar.'" alt="image"/></a>');
	}
	function show_story($post){
		$link_user = '<a href="https://fb.com/'.$post->from->id.'" title="" target="_blank"><b>'.$value->from->name.'</b></a>';
		$username = $value->from->name;
		$link_group = '<a href="https://fb.com/'.$this->id.'">'.$this->name.'</a>'; 
		if(!isset($value->story))
		{
			echo($link_user.' <span class="glyphicon glyphicon-triangle-right text-muted" style="font-size:10px;"></span> <b>'.$link_group.'</b>');
			return;
		}
		$story = $value->story;
		$story = str_replace($value->from->name, $link_user.'<span class="text-muted">', $story);
		$story = str_replace($this->name, $link_group.'</span>', $story);
		echo("\n".$story);
	}
	function getPathShowError(){
		return $this->path_show_error;
	}
	function setData()
	{
		$this->access_token = empty($this->access_token) ? $_COOKIE['token'] : $this->access_token;
		$this->id = empty($_GET['id']) ? 'me' : $_GET['id'];
		$this->link = 'https://graph.facebook.com/'.$this->id.'?access_token='.$this->access_token;
		$this->json_string = viewsource($this->link);
		$this->json = json_decode( $this->json_string );
		if(isset($this->json->error))
		{
			echo($this->json->error->message);
			echo($this->json_string);
			header("Location: $this->path_show_error"."login.html");
			exit();
		}
		$this->name = $this->json->name;
	}

	function graph($id, $fields='', $version=''){
		$this->link=$this->graph.$version.'/'.$id.'?fields='.$fields.'&access_token='.$this->access_token;
		$this->json_string = viewsource($this->link);
		$this->json = json_decode($this->json_string);
		return $this->json;
	}

	function graph_all($id, $fields, $data_name, $limit, $version='')
	{
		$this->link=$this->graph.$version.'/'.$id.'?fields='.$fields.'&access_token='.$this->access_token;
		echo('<a href="'.$this->link.'" target="_blank"> Link graph '.$data_name.'</a><br>');
		$data    = array();
		$data_tg = array();

		$this->json = json_decode( viewsource($this->link) );
		$data_tg = &$this->json->$data_name->data;
		$data_tg = empty($data_tg) ? array() : $data_tg;
		$data = array_merge($data, $data_tg);
		if(!isset($this->json->$data_name->paging->next) || sizeof($data_tg)<$limit)
			return $data;
		
		$this->link = $this->json->$data_name->paging->next;
		while(!empty($this->link)  && sizeof($data_tg)<= $limit)
		{
			echo('<a href="'.$this->link.'" target="_blank"> Link graph</a><br>');
			$this->json = json_decode( viewsource($this->link) );
			$data_tg = $this->json->data;
			$data = array_merge($data, $data_tg);
			$this->link = empty($this->json->paging->next) ? '' : $this->json->paging->next;
		}
		return $data;
	}
	function show_creat_time(&$value)
	{
		$cach_day=strtotime('now')-strtotime($value->created_time);
		$gio  = (int)($cach_day/3600);
		$phut = (int)($cach_day/60);
		$time = (int)$cach_day ? 'Vừa xong' : 'chịu'; /*giay*/
		$time = $phut ? $phut.' phút' : $time;
		$time = $gio  ? $gio. ' giờ ' : $time;
		echo("<a href=\"$value->permalink_url\" title=\"\" class=\"small text-muted\" target=\"_blank\">$time</a>");
	}

	function show_message($value, $Keo){
		if(isset($value->message))
			echo(xu_ly(htmlentities($value->message), $Keo));
	}

	function show_source($value){
		if(!isset($value->source)) return;
		if(strpos($value->source, 'https://www.youtube.com')>-1)
			echo '<iframe width="100%" height="270" src="'.str_replace('?autoplay=1', '?autoplay=0', $value->source).'" frameborder="0" allowfullscreen></iframe>';
			else
			{?>
				
				<!-- <div class="anhzz"> -->
					<!-- <img src="<?php //echo($value->full_picture); ?>" class="anh1"> -->
				<!-- <div class="anh2"> -->
						<?php echo('<video class="center-block" controls><source src="'.$value->source.'" type="video/mp4"></video>'."\n"); ?>
					<!-- </div> -->
				<!-- </div> -->
		<?php
				// echo('<video class="center-block" style="background-image: url('.$value->full_picture.')" controls><source src="'.$value->source.'" type="video/mp4"></video>'."\n");
			}
			
	}
	
	function show_full_picture(&$value){
		if(isset($value->source))	return;
		if(isset($value->full_picture))
		{
			$url_image = empty($value->picture) ?  urldecode($value->full_picture) : $value->picture;
			if($value->type=='link')
			{
				$description = empty($value->description)? '' : $value->description;
				$caption = empty($value->caption)? '' : $value->caption;
			?>
	<div class="di_link">
		<a href="<?php echo($value->link); ?>" class="icon">
			<img src="<?php echo($url_image); ?>">
		</a>
		<a href="<?php echo($value->link); ?>" class="chu_thich" target="_blank">
			<b><?php echo($value->name); ?></b>
			<p class="small"><?php echo($description); ?></p>
			<p class="small text-muted"><?php echo($caption); ?></p>
		</a>
	</div>
			<?php
			}
			else
			{
				echo('	<a href="'.$value->permalink_url.'" target="_blank">');
				echo('	<img src="'.$value->full_picture.'"></a>');
			}	
		}
	}
	function body_post(&$value)
	{
		$this->show_message($value, $this->Keo);
		$this->show_source($value);	   /*video nếu có*/
		$this->show_full_picture($value); /*ảnh nếu có*/
	}
	function show_link_graph(){
		echo '<a href="'.$this->link.'" target="_blank">Grap</a>';
	}
	function find_id($link)
	{
		$text = viewsource($link);
		$text = strstr($text, 'fb://');
		$text = substr($text, 0, strpos($text, '"'));
		$text = str_replace('fb://', '', $text);
		$text = strstr($text, '/');
		$text = str_replace('/', '', $text);
		$text = empty($text) ? $_GET['name'] : $text;
		return $text;
	}
	function post_comment($id_post, $text)
	{
		
	}
	function menu()
	{
		echo("<a href=\"$this->path_show_error"."logout.php\">");
		echo('<button type="button" class="btn btn-default">Logout</button>');
		echo('</a>');
	}
	function show_post($value)
	{
		
	}
	public function showError()
	{
		print_r($this->json_string);
	}









}
?>