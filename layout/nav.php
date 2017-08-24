<?php require_once __DIR__ . '/../data/chuc-nang.php'; ?>
<style>
	body{padding-top: 85px;}
</style>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/">Socola World</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li>
			<li><a href="#">Page 3</a></li>
		</ul>
		<!-- bên phải -->
		<ul class="nav navbar-nav navbar-right">
			<!-- giới thiệu -->
			<li><a href="#" title="">Giới thiệu</a></li>
			<!-- ứng dụng -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Ứng dụng
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
							foreach ($chucNang as $key => $value) {
								$value->showForNav();
							}
						?>
						<!-- <li><a href="/app/get-link-shutterstock/">Get link Shutterstock</a></li>
						<li><a href="/app/check-live-token/">Check live Token</a></li>
						<li><a href="/app/encode-decode/">Encode decode</a></li>
						<li><a href="/app/comments-checker/">Comments checker</a></li> -->
					</ul>
				</li>
				<li><a href="#">Liên hệ</a></li>
				<?php if ($login){ ?>
				<!-- đăng xuất -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Socola Đại Ca
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
	</nav>