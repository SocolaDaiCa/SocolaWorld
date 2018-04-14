<!DOCTYPE html>
<html lang="vn">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login</title>
		@include('site.elements.header')
		@include('site.elements.css')
		<link rel="stylesheet" href="{{asset('vendor/socola.dai.ca/css/login.css')}}">
	</head>
	<body id="body">
		<br><br>
		<div class="container flogin" onsubmit="return validateForm()">
			<form action="{{route('site.login')}}" method="POST" role="form">
				<!-- login with Facebook -->
				<div class="row form-group text-center">
					<a href="{{ route('site.login.facebook') }}">
						<img src="{{url('vendor/socola.dai.ca/images/img-lg-with-facebook.png')}}" alt="login-With-Facebook" style="height: 45px">
					</a>
				</div>
				<h4 class="or">Hoặc</h4>
				<!-- login with email and password -->
				<div class="row form-group">
					<!-- username -->
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<span class="label label-primary">Tài khoản</span>
						<input id="email" type="text" class="form-control" name="email" placeholder="Email or phone">
					</div>
					<!-- password -->
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<span class="label label-primary">Mật khẩu</span>
						<input id="password" type="password" class="form-control" name="password" placeholder="Password">
					</div>
				</div>
				<h4 class="or">Hoặc</h4>
				<!-- login with token -->
				<div class="row form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<span class="label label-primary">Token</span>
						<input type="text" class="form-control" id="token" placeholder="EAACEdEose0cBAITP2FZAvl9sq9MC9WSFShsw35JOUuz2aIgjbcl1suZCqDCH5COwynCF8hnlZCtwImHeXdHnMQNTesJp0x1jsdgG91Reug0ATnsAA1elYsmTVGaYSVAYv9PtRYmKEwJKAW1AwlSAtMFRQ14kjaQQYZAZBzMJAKSsbdvLdz26ByAlKXe8g70gZD" name="token">
					</div>
				</div>
				<!-- remember me -->
				<div class="row form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="checkbox text-white">
							<label><input type="checkbox" name="autologin"> Duy trì đăng nhập</label>
						</div>
					</div>
				</div>
				<!-- list button -->
				<div class="row form-group footer-login text-justify">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<!-- button login -->
						<button type="submit" id="submit" class="btn btn-primary">Đăng nhập</button>
						<!-- button lấy token graph -->
						<a href="https://developers.facebook.com/tools/explorer" class="btn btn-default" data-toggle="tooltip" title="Lấy token của ứng dụng" target="_blank">Lấy Token Graph FB</a>
						<!-- button hướng dẫn -->
						<a href="huong-dan.html" class="btn btn-info" target="_blank">Hướng dẫn</a>
						<!-- button try demo -->
						<button type="button" id="trydemo" class="btn btn-primary">Dùng thử</button>
					</div>
				</div>
			</form>
		</div>
		@include('site.elements.js')
	</body>
</html>