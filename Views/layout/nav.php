<?php
	require_once __DIR__ . '/../../Controller/Controller_Layout.php';
	$cLayout = new Controller_Layout;
?>
<style>
	body{padding-top: 85px;}
</style>
<nav class="navbar navbar-default navbar-fixed-top" style="background: #444">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Socola World</a>
		</div>
		<!-- <ul class="nav navbar-nav">
								<li><a href="#">Page 1</a></li>
								<li><a href="#">Page 2</a></li>
								<li><a href="#">Page 3</a></li>
		</ul> -->
		<!-- bên phải -->
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<!-- giới thiệu -->
				<li><a href="/" title="">Giới thiệu</a></li>
				<!-- ứng dụng -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Ứng dụng
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php foreach ($cLayout->getCategory() as $key => $item): ?>
							<?php  ?>			
							<?php foreach ($cLayout->getApps($item->key) as $key => $app): ?>
							<li><a href="/apps/<?php echo$app->path ?>"><i class="<?php echo$app->icon ?>"></i> <?php echo$app->name ?></a></li>
							<?php endforeach ?>
							<li class="divider"></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li><a href="#">Liên hệ</a></li>
					<li><a href="https://socoladaica.blogspot.com">Blog</a></li>
					<?php if ($_SESSION["login"] ?? FALSE){ ?>
					<!-- đăng xuất -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo($_COOKIE['username']) ?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/logout.php">Đăng xuất</a></li>
						</ul>
					</li>
					<?php } else { ?>
					<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php } /*endif*/ ?>
					
				</ul>
			</div>
		</div>
	</nav>