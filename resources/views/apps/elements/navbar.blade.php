<style>
	body{padding-top: 60px;}
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
		<!-- bên phải -->
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<!-- giới thiệu -->
				<li><a href="/" title="">Giới thiệu</a></li>
				<!-- ứng dụng -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ứng dụng <span class="caret"></span></a>
					<ul class="dropdown-menu">
						@foreach($categorys as $category)
						<li><a href="#" title=""><b>{{$category->name}}</b></a></li>
						@foreach($category->apps as $app)
						<li><a href="/apps/{{$app->path}}"><i class="{{$app->icon}}"></i> {{$app->name}}</a></li>
						@endforeach
						<li class="divider"></li>
						@endforeach
					</ul>
				</li>
				<li><a href="#">Liên hệ</a></li>
				<li><a href="https://blog.socolaworld.ga">Blog</a></li>
				<!-- đăng xuất -->
				@if($user)
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="glyphicon glyphicon-user"></span>
						{{$user->name}}
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{route('site.login')}}">Đăng xuất</a></li>
					</ul>
				</li>
				@else
				<li><a href="{{route('site.login')}}"> Login</a></li>
				@endif
			</ul>
		</div>
	</div>
</nav>