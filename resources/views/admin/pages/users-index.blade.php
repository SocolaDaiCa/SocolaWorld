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
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $index => $user)
		<tr>
			<td class="text-center">{{$index + 1}}</td>
			<td><a href="https://fb.com/{{$user->user_id}}" title="{{$user->name}}" target="_blank"><b>{{$user->name}}</b></a></td>
			<td><span class="{{$user->permission->class}}">{{$user->permission->name}}</span></td>
			<td>
				<a href="{{ route('admin.users.edit', $user->id) }}" title=""><i class="fa fa-gear"></i></a>
				<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="inline">
					@csrf @method('PUT')
					<button type="submit" name="permission_id" value="3" class="btn-link p0 m0"><i class="fa fa-ban text-danger"></i></button>
					<button type="submit" name="permission_id" value="1" class="btn-link p0 m0"><i class="fa fa-check-circle text-success"></i></button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $users->links() }}
@endsection