<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('header')
		@include('admin.css')
		@yield('css')
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				@include('admin.nav-left')
				@include('admin.nav-top')
				<!-- page content -->
				<div class="right_col" role="main">
					@yield('content')
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
		@include('admin.js')
		@yield('js')
	</body>
</html>