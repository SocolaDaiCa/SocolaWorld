@extends('apps.layout')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/api.index.css')}}">
@endsection
@section('content')
<?php ?>
<div class="container">
	<h2>Find my Facebook ID</h2>
	{{$path}}/find-my-fb-id?q={scopeID}&token=<b class="value">{access_token}</b>
	<h2>Get Token Facebook</h2>
	{{$path}}/api/get-token-facebook?u=<b class="value">{username}</b>&p=<b class="value">{password}</b>&t=<b class="value">{type}</b><br>
	Type: <b>android</b>(default), <b>iphone</b>, <b>iosforpage</b>.
	<h2>Short link google</h2>
	{{$path}}/api/short-link-google?u=<b class="value">{urlNeedShort}</b>
</div>
@endsection
