<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		@include('site.elements.header')
		@yield('header')
		@include('apps.elements.css')
		@yield('css')
	</head>
	<body>
		@include('apps.elements.navbar')
		<div id="app">
			@yield('content')
		</div>
		@include('apps.elements.js')
		@yield('js')
	</body>
</html>