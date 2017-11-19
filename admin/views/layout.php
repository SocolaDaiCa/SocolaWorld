<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Socola Admin</title>
		<?php require_once __DIR__ . '/css.php'; ?>
		
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<?php require_once __DIR__ . '/nav-left.php'; ?>
				<?php require_once __DIR__ . '/nav-top.php'; ?>
				<!-- page content -->
				<div class="right_col" role="main">
					<?php
						if(is_file(__DIR__ . "/page/{$page}.php"))
							require_once __DIR__ . "/page/{$page}.php";
						if(is_file(__DIR__ . "page/{$page}.html"))
							require_once __DIR__ . "/{$page}.html";
					?>
				</div>
				<!-- /page content -->
				<!-- footer content -->
				<footer>
					<div class="pull-right">
						Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>
		<?php require_once __DIR__ . '/js.php'; ?>
	</body>
</html>