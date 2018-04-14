@extends('admin.layouts.base')
@section('header')
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="row tile_count">
	<!-- total Users -->
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> <a href="" title="">Total Users</a></span>
		<div class="count">{{$totalUsers}}</div>
		<span class="count_bottom"><i class="green">0% </i> From last Week</span>
	</div>
	<!-- end total Users -->
	<!-- categorys -->
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Categorys</span>
		<div class="count">{{$totalCategorys}}</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
	</div>
	<!-- /categorys -->
	<!-- apps -->
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Apps</span>
		<div class="count">{{$totalApps}}</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Males</span>
		<div class="count green">2,500</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Females</span>
		<div class="count">4,567</div>
		<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
		<div class="count">2,315</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
</div>
@endsection