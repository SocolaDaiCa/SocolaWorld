@extends('apps.layout')
@section('header')
<title>Check live Token</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/check-live-token/css/index.css')}}">
@endsection
@section('js')
<script src="{{asset('vendor/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('app/check-live-token/js/index.js')}}"></script>
@endsection
@section('content')
<div class="container">
	<div class="text-center">
		<h1>Check live Token</h1>
	</div>
	<div class="form-group">
		<span>Nhập danh sách token, mỗi token nằm trên 1 dòng</span>
		<input type="file" name="" value="" placeholder="" id="tokenfile">
		<textarea v-model="tokens" class="form-control" rows="10" required="required">
		</textarea>
	</div>
	<div class="">
		All: @{{all}}, Live: @{{live}}, die: @{{die}}
	</div>
	<div class="form-group">
		<button @click="check" class="btn btn-primary">Check token</button>
		<button id="clear-result" class="btn btn-default">
		<i class="fa fa-recycle"></i> Clear result</button>
		<button id="unique" class="btn btn-default">Unique</button>
		<button type="button" class="btn btn-default" data-clipboard-action="copy" data-clipboard-target="#token-input">
		<i class="fa fa-copy"></i> Copy to clipboard</button>
		<button type="button" class="btn btn-default" data-clipboard-action="cut" data-clipboard-target="#token-input">
		<i class="fa fa-cut"></i> Cut to clipboard</button>
	</div>
	{{-- <span id="countToken"></span> <span id="result"></span> --}}
{{-- 	<p>Result</p>
	<ol id="result-live" class="bg-success">
		<li v-for="item in res">@{{item}}</li>
	</ol> --}}
</div>
@endsection