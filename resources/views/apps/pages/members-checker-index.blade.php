@extends('apps.layout')
@section('header')
<title>Check members</title>
@endsection
@section('js')
<script src="{{asset('app/members-checker/js/index.js')}}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/members-checker/css/index.css')}}">
@endsection
@section('content')
<div class="header text-center">
	<h1>Members Checker</h1>
	<p>Kiếm tra 1 thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không</p>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="form-group">
				<span>Nhóm A</span>
				<select  title="Pick a number" class="form-control" id="list-groups-a">
					<option v-for="group in listGroups" data-id-group="@{{group.id}}">@{{group.name}}</option>
				</select>
			</div>
			<span>Nhóm B</span>
			<div class="form-group">
				<select  title="Pick a number" class="form-control" id="list-groups-b">
					<option v-for="group in listGroups" data-id-group="@{{group.id}}">@{{group.name}}</option>
				</select>
			</div>
			<div class="form-group">
				<button type="button" v-on:click="start" class="btn btn-primary">Kiểm tra</button>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Kết quả kiếm tra: @{{status}}</div>
				<div class="panel-body">
					
				</div>
				
				<!-- Table -->
				<table class="table">
					<thead>
						<tr>
							<th>Thành viên</th>
							<th>Thuộc</th>
						</tr>
					</thead>
					<tbody v-for="member in members.list">
						<tr>
							<td>
								<a href="https://fb.com/@{{member.id}}" title="" target="_blank">@{{member.name}}</a>
							</td>
							<td><i class="@{{member.check}}"></i></td>
							<!-- <td> <i class="fa fa-check-square-o"></i> </td> -->
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection