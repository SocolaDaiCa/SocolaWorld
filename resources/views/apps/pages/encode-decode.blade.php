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
	<div class="row">
		<div class="col-lg-6">
			<label for="">Input</label>
			<textarea name="" id="input" class="form-control" rows="15" required="required"></textarea>
		</div>
		<div class="col-lg-6">
			<label for="">Output</label>
			<textarea name="" id="output" class="form-control" rows="15" required="required"></textarea>
		</div>
	</div>
	<div class="row action">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group">
				<button name="urldecode" class="btn btn-primary">Url decode</button>
				<button name="urlencode" class="btn btn-primary">Url encode</button>
			</div>
			<div class="form-group">
				<button name="base64_decode" class="btn btn-primary">Base64 decode</button>
				<button name="base64_encode" class="btn btn-primary">Base64 encode</button>
			</div>
			<div class="form-group">
				<button name="hexToString" class="btn btn-primary">Hex to String</button>
			</div>
			<div class="form-group">
				<button name="md5" class="btn btn-primary">md5</button>
			</div>
		</div>
	</div>
</div>
@endsection