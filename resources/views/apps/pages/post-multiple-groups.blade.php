@extends('apps/layout')
@section('header')
<title>Post Multiple Groups</title>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app/post-multiple-groups/css/index.css')}}">
@endsection
@section('js')
<script src="{{asset('app/post-multiple-groups/js/index.js')}}"></script>
@endsection
@section('content')
<div class="container">
	<div class="text-center">
		<h1>Post Multiple Groups</h1>
		<p>Viết bài lên nhiều nhóm chỉ với 1 lần đăng <span class="text-warning">Token Android</span>.</p>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div id="new-post">
			<div class="media">
				<div class="media-left">
					<img src="{{$user->avatar}}" class="media-object img-circle" style="width:55px">
				</div>
				<div class="media-body">
					<!-- <h4 class="media-heading">John Doe</h4> -->
					<div class="form-group">
						<textarea name="" id="input" class="form-control" required="required" onkeyup="auto_grow(this)" placeholder="Bạn đang nghĩ gì?" v-model="message"></textarea>
					</div>
					<div class="form-group">
						Tới: <span v-for="group in listGroupsWillPost">&nbsp;<span class="label label-primary">@{{group.name}}</span> </span>
					</div>
					<button type="button" class="btn btn-primary btn-small pull-right" v-on:click="post">Đăng</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		Danh sách nhóm
		<div class="form-group">
			<div class="checkbox" v-for="group in listGroups">
				<label>
					<input type="checkbox" v-bind:value="group" v-model="listGroupsWillPost">
					@{{group.name}}
				</label>
			</div>
		</div>
	</div>
</div>
@endsection