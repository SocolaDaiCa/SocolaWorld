@extends('apps.layout')
@section('header')
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app/vsbg/css/index.css')}}">
@endsection
@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://imagesloaded.desandro.com/imagesloaded.pkgd.js"></script>
<script src="{{asset('vendor/masonry/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('app/vsbg/js/index.js')}}"></script>
@endsection
@section('content')
<div class="grid">
	<div class="grid-sizer"></div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" />
	</div>
	<div class="grid-item">
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" />
	</div>
</div>
@endsection