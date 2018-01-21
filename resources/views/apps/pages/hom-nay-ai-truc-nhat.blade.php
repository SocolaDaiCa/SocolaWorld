<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Hôm nay ai trực nhật - {{$groupName}}</title>
		@include('site.elements.header')
		<meta name="keywords" content="Hom nay ai truc nhat"/>
		<meta name="description" content="Hôm nay ai trực nhật?">
		<link rel="image_src" href="/frontend/images/nu-cuoi-phan-dien.jpg"/>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&amp;subset=vietnamese" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('app/hom-nay-ai-truc-nhat/css/index.css')}}" type="text/css" />
		{!!'<script>var groupID = '.$groupID.';</script>'!!}
	</head>
	<body id="app">
		<br>
		<h1>Hôm nay ai trực nhật <br> {{$groupName}}</h1>
		<div id="queue">
			<span class="title">LƯỢT ƯU TIÊN</span>
			<transition-group name="flip-list">
				<div v-for="(index, user) in users" class="user-div" data-id="@{{user[0]}}">
					<span class="id">@{{index +1}}</span>
					<span class="avatar white">s<img v-bind:src="user.avatar" alt=""></span>
					<span class="name"><a href="//fb.com/@{{user.user_id}}" title="" target="_blank">@{{user.user_name}}</a></span>
					<span class="button button-queue white" @click="queue(user.id)">queue</span>
					<span style="width: 24px;"></span>
					<span class="button button-down white" @click="done(user.id)">done</span>
					<span style="width: 24px;"></span>
					<span class="id ">@{{user.counter}}</span>
				</div>
			</transition-group>
		</div><div id="order">
		<!--
			<span class="title">LƯỢT MẶC ĐỊNH</span>
		<?php
		// foreach ($save->order as $order) {
		// echo '<div id="user-'.$order.'" class="user-div" data-id="'.$order.'"><span class="id">'.$order.'</span><span class="avatar"
		// style="background-image: url(\''.$data[$order]['photo'].'\')">
		// </span><span class="name">'.$data[$order]['name'].'</span> <a class="button button-down">done</a> <a class="button button-queue">queue</a></div>';
		// }
		?>
	</div> -->
	<!-- <div class="save"><a class="button button-save">save order</a> -->
</div>
@include('site.elements.js')
<script src="{{asset('app/hom-nay-ai-truc-nhat/js/index.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.14.1/lodash.min.js"></script>
</body>
</html>