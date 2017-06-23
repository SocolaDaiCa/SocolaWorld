<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/rank.css">
</head>
<body>
<pre>
<?php
	class USER{
		private $name = '';
		private $like_to = 0;
		private $like_in = 0;
		private $post = 0;
		private $comment_to = 0;
		private $comment_in = 0;
		function __construct($name)
		{
			$this->name = $name;
		}
		public function like_to(){ $this->like_to++;}
		public function like_in(){ $this->like_in++;}
		public function post(){ $this->post++;}
		public function comment_to(){ $this->comment_to++;}
		public function comment_in(){ $this->comment_in++;}

		public function getName(){ return $this->name;}
		public function getLike_to(){ return $this->like_to;}
		public function getLike_in(){ return $this->like_in;}
		public function getPost(){ return $this->post;}
		public function getComment_to(){ return $this->comment_to;}
		public function getComment_in(){ return $this->comment_in;}
		public function score()
		{
			$score = 0;
			$score += $this->post*3;
			$score += $this->like_to*1;
			$score += $this->like_in*1;
			$score += $this->comment_to*2;
			$score += $this->comment_in*2;
			return $score;
		}
	}
	set_time_limit(0);
	include_once '../source.php';
	$start = strtotime("now");
	$fb = new FB();
	$fb->check_token();
	$id = $_GET['id'];
	$limit = 980;
	$since = strtotime("today -30 day");

	$field='members.limit('.$limit.'){id,name}';
	$arr_user = $fb->graph_all($id, $field, 'members', $limit,'v2.9');
	echo(sizeof($arr_user));
	$user = array();
	foreach ($arr_user as $key => $value)
		$user[$value->id] = new USER($value->name);

	$query='feed.limit(250).since('.$since.'){from}';
	$arr_post = $fb->graph_all($id, $query, 'feed', $limit,'v2.9');
	foreach ($arr_post as $post) {
		if(array_key_exists($post->from->id, $user)==false)
			$user[$post->from->id] = new USER('No name');
		$user[$post->from->id]->post();

		$query='reactions.limit(250).since('.$since.'){id}';
		$user_reactions = $fb->graph_all($post->id, $query, 'reactions', $limit,'v2.9');
		foreach ($user_reactions as $user_tg) {
			if(array_key_exists($user_tg->id, $user)==false)
				$user[$user_tg->id] = new USER('No name');

			$user[$user_tg->id]->like_to();
			$user[$post->from->id]->like_in();
		}
		// print_r($user_reactions);
		$query='comments.limit(250).since('.$since.'){from{id}}';
		$arr_comments = $fb->graph_all($post->id, $query, 'comments', $limit,'v2.9');
		// print_r($arr_comments);
		if(sizeof($arr_comments)>0)
		foreach ($arr_comments as $comment) {
			if(array_key_exists($comment->from->id, $user)==false)
				$user[$comment->from->id] = new USER('No name');

			$user[$comment->from->id]->comment_to();
			$user[$post->from->id]->comment_in();
		}
		// print_r($user_comments);
	}
	// print_r($arr_post);
	// print_r($user);
?>
<?php 
	$finish = strtotime("now");
	echo('<br>hết'.($finish-$start));
	echo('xong');
?>
</pre>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
			<th>STT</th>
				<th>id</th>
				<th>Tên</th>
				<th>bài đăng</th>
				<th>like dạo</th>
				<th>được like</th>
				<th>bình luận dạo</th>
				<th>được bình luận</th>
				<th>điểm số</th>
			</tr>
		</thead>
		<tbody>
			<?php $stt=1; ?>
			<?php foreach ($user as $id => $value) { ?>
			<tr>
				<td><?php echo($stt++); ?></td>
				<td><?php echo($id); ?></td>
				<td><?php echo($value->getName()); ?></td>
				<td><?php echo($value->getPost()); ?></td>
				<td><?php echo($value->getLike_to()); ?></td>
				<td><?php echo($value->getLike_in()); ?></td>
				<td><?php echo($value->getComment_to()); ?></td>
				<td><?php echo($value->getComment_in()); ?></td>
				<td><?php echo($value->score()); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>