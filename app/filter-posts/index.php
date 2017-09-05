<?php require_once '../../check-login.php'; ?>
<!DOCTYPE html>
<html lang="vn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Filter posts</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
		<!-- <link rel="stylesheet" href="css/list_groups.css"> -->
		<link rel="stylesheet" type="text/css" href="css/filter-posts.css">
	</head>
	<body id="app">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<ul id="list-groups">
				<li v-for="group in listGroups">
					<!-- <a class="crop small" v-on:click= title="">{{group.name}}</a> -->
				</li>
			</ul>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<div class="list-posts">
				<div class="post"  v-for="(index, post) in listPosts">
					<!-- avatar -->
					<!-- <a href="https://fb.com/{{status.from.id}}" target="_blank">
								<img alt="image" src=""/>
					</a> -->
					<!-- username -->
					<!-- <a href="https://fb.com/${target.id}">{{status.from.name}}</a> -->
					<!-- header -->
					<div class="post-header">
						<div class="media">
							<div class="media-left">
								<img src="https://graph.facebook.com/{{post.from.id}}/picture?type=large&redirect=true&width=40&height=40" class="media-object" height="40px" width="40px">
							</div>
							<div class="media-body">
								<!-- <h4 class="media-heading"> -->
								<b><a href="//fb.com/{{post.from.id}}" title="">{{post.from.name}}</a>
								<i class="fa fa-caret-right text-muted"></i>
								<a href="//fb.com/{{groupId}}" title="">{{groupName}}</a>
								</b><br>
								<b>{{index + 1}}</b>
								<a class="text-muted small" target="_blank" href="{{post.permalink_url}}">{{post.created_time}}</a>
								<!-- </h4> -->
								<p></p>
							</div>
						</div>
					</div>
					<!-- post body -->
					<div class="post-body">
						<p>{{post.message}}</p>
						<!-- ảnh -->
						<a v-if="post.permalink_url" href="{{post.permalink_url}}" target="_blank">
							<img v-bind:src="post.full_picture" alt="aaaaaaaaaaaaaaaaaaaaaaaaaa">
						</a>
						<!-- video -->
					</div>
					<!-- post footer -->
					<div class="post-footer">
						<div class="action">
							<a href="#/">
								<span id="${index}_like">
									<i class="fa fa-thumbs-up"></i>
									<b class="small">Thích</b>
								</span>
							</a>&nbsp;&nbsp;
							<a href="{{post.permalink_url}}" target="_blank">
								<span class="glyphicon glyphicon-comment"></span>
								<b class="small">Bình luận</b>
							</a>&nbsp;&nbsp;
							<a href="{{post.permalink_url}}" target="_blank">
								<span class="glyphicon glyphicon-share-alt"></span>
								<b class="small">Chia sẻ</b>
							</a>
						</div>
						<div class="rearction">
							<a href="#/" class="text-muted like">{{post.likes.summary.total_count}}</a>
							<a href="${status.permalink_url}" target="_blank" class="text-muted comment">
								{{status.comments.summary.total_count}}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php require_once '../../layout/js.php'; ?>
<script src="filter-posts.js"></script>