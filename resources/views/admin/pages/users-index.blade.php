@extends('admin.layouts.base')
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
			<th>Permission</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $index => $user)
		<tr>
			<td class="text-center">{{$index + 1}}</td>
			<td><a href="https://fb.com/{{$user->user_id}}" title="{{$user->name}}" target="_blank">{{$user->name}}</a></td>
			<td><span class="label label-success">{{$user->permission->name}}</span></td>
			{{-- <td class="word-wrap"></td> --}}
			<td>
				<a href="{{ route('admin.users.edit', $user->id) }}" title=""><i class="fa fa-edit"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $users->links() }}
@endsection