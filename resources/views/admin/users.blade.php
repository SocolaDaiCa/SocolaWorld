@extends('admin.layout')
@section('header')
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<style>
	.word-wrap{
		max-width: 10px;
		word-wrap: break-word;
	}
</style>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $index => $user)
		<tr>
			<td class="text-center">{{$index + 1}}</td>
			<td><a href="https://fb.com/{{$user->user_id}}" title="{{$user->name}}" target="_blank">{{$user->name}}</a></td>
			<td class="word-wrap"></td>
			<td><span class="label label-success">Admin</span></td>
			<td><a class="label label-success">Set User</a></td>
			<td><span class="label label-default">User</span></td>
			<td><a class="label label-success">Set Admin</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection