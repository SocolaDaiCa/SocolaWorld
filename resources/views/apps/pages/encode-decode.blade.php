@extends('apps.layout')
@section('header')
<title>Encode - Decode</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/encode-decode/css/index.css')}}">
@endsection
@section('js')
<script src="{{asset('app/encode-decode/js/index.js')}}"></script>
@endsection
@section('content')
<div class="container">
	<div class="form-group">
		<div class="row">
		<div class="col-lg-6">
			<label for="">Input:</label>
			<textarea class="form-control" rows="15" v-model="input"></textarea>
		</div>
		<div class="col-lg-6">
			<label for="">Output</label>
			<textarea class="form-control" rows="15" v-model="output"></textarea>
		</div>
	</div>
	</div>
	<div class="row action">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group">
				<button v-on:click="callAPI('urldecode')" class="btn btn-primary">Url decode</button>
				<button v-on:click="callAPI('urlencode')" class="btn btn-primary">Url encode</button>
				<button v-on:click="randomPassword" class="btn btn-primary">Random Password</button>
			</div>
			<div class="form-group">
				<button v-on:click="callAPI('base64_decode')" class="btn btn-primary">Base64 decode</button>
				<button v-on:click="callAPI('base64_encode')" class="btn btn-primary">Base64 encode</button>
			</div>
			<div class="form-group">
				<button v-on:click="callAPI('hexToString')" class="btn btn-primary">Hex to String</button>
				<button class="btn btn-primary" v-on:click="filterDuplicate">Filter duplicate</button>
			</div>
			<div class="form-group">
				<button v-on:click="callAPI('md5')" class="btn btn-primary">md5</button>
				<button v-on:click="callAPI('slug')" class="btn btn-primary">Slug</button>
			</div>
		</div>
	</div>
</div>
@endsection