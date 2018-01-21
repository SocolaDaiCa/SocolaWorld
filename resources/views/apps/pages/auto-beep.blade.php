@extends('apps.layout')
@section('header')
<title>Auto beep</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/auto-beep/css/index.css')}}">
@endsection
@section('js')
<script src="{{asset('app/auto-beep/js/index.js')}}"></script>
@endsection
@section('content')
<div id="app">
	<div class="container">
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
				aria-valuemin="0" aria-valuemax="100" style="width:40%">
				40% Complete
			</div>
		</div>
	</div>
	<div class="container checkbox radio">
		<div class="col-md-3">
			<fieldset>
				<legend>Mục tiêu</legend>
				<!-- <label><input type="checkbox">Chửi cả New Feed</label> -->
				<!-- <label><input type="checkbox">Gặp ai cũng chửi</label> -->
				<!-- <label><input type="checkbox" v-model="chuiFriends">Chửi tất cả trừ bạn bè</label> -->
				<!-- <label><input type="checkbox" v-model="!chuiFriends">Chửi bạn bè</label> -->
				<!-- <label><input type="checkbox">Chửi thằng đăng status</label> -->
				<!-- <label><input type="checkbox">Chửi thằng bình luận</label> -->
				<label><input type="checkbox" v-model="chuiTheoStatusId">Chửi theo danh sách Status ID:</label>
				<textarea rows="5" v-show="chuiTheoStatusId" v-model="str.ListStatusIDs"></textarea>
				<!-- <label><input type="checkbox" v-model="chuiTheoUserId">Chửi theo danh sách User ID:</label> -->
				<!-- <textarea rows="5" :disabled="!chuiTheoUserId" v-model="listUsers"></textarea> -->
			</fieldset>
		</div>
		<div class="col-md-3">
			<fieldset>
				<legend>Cách chửi</legend>
				<!-- 					<label><input type="checkbox">Chửi có văn hóa</label>
				<label><input type="checkbox">CHửi tất cả status trên News Feed</label>
				<label><input type="checkbox">Chửi tất cả Group, Page đã tham gia</label>
				<label><input type="checkbox">Chửi theo số đông</label>
				<label><input type="checkbox">Chửi có chiều sâu</label>
				<label><input type="checkbox">Chửi có Logic</label>
				<label><input type="checkbox">Chửi kiểu trẻ trâu</label>
				<label><input type="checkbox">Chửi theo vùng miền</label>
				<label><input type="checkbox">Chửi đổng</label>
				<label><input type="checkbox">Chửi theo nội dung Status</label>
				<label><input type="checkbox">Tự tìm logic để chửi</label> -->
			</fieldset>
		</div>
		<div class="col-md-3">
			<fieldset>
				<legend>Cấu hình</legend>
				<!-- 					<label><input type="checkbox">Vừa chửi vừa like</label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label>
				<label><input type="checkbox"></label> -->
			</fieldset>
			<fieldset>
				<legend>Thời gian chửi @{{time}}</legend>
				<label><input type="radio" v-model="time" value="1">Chửi trong 1 phút</label>
				<label><input type="radio" v-model="time" value="15">Chửi trong 15 phút</label>
				<label><input type="radio" v-model="time" value="30">Chửi trong 30 phút</label>
				<label><input type="radio" v-model="time" value="60">Chửi trong 60 phút</label>
				<label><input type="radio" v-model="time" value="0">Chửi không ngừng nghỉ</label>
				chửi sau mỗi: <input type="text" v-model="intervalTime" size="1" maxlength="4"> giây
			</fieldset>
			<div class="form-group">
				<button type="button" class="btn btn-primary" id="start" v-on:click="start">Bắt đầu chửi</button>
				<button type="button" class="btn btn-default" id="stop" v-on:click="stop">Dừng</button>
			</div>
		</div>
	</div>
</div>
@endsection