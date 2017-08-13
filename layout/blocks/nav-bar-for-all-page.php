<?php $login = $_GET['l'] ?? false; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>nav bar</title>
		<?php require_once 'header-for-all-page.php'; ?>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Socola World</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Page 1</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
				<!-- bên phải -->
				<ul class="nav navbar-nav navbar-right">
					<!-- ứng dụng -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ứng dụng
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">App1</a></li>
								<li><a href="#">App1</a></li>
								<li><a href="#">App1</a></li>
							</ul>
						</li>
						<li><a href="#">Liên hệ</a></li>
						<!-- đăng xuất -->
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Socola Đại Ca
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Đăng xuất</a></li>
							</ul>
						</li>
						<?php if ($login): ?>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<?php endif ?>
						
					</ul>
				</div>
			</nav>
			
			<div class="container" style="margin-top:50px">
				<h3>Fixed Navbar</h3>
				<div class="row">
					<div class="col-md-4">
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
					</div>
					<div class="col-md-4">
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
					</div>
					<div class="col-md-4">
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
						<p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
					</div>
				</div>
			</div>
			<h1>Scroll this page to see the effect</h1>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>s
			<?php require_once 'footer-for-all-page.php'; ?>
		</body>
	</html>