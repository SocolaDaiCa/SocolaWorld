<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@include('site.elements.header')
		@yield('header')
		@include('apps.inc.css')
		@yield('css')
	</head>
	<body>
		@include('apps.inc.navbar')
		<div id="app">
			@yield('content')
		</div>
		@include('apps.inc.js')
		@yield('js')
	</body>
</html>