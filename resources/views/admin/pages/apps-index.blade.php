@extends('admin.layouts.base')
@section('content')
<table class="table table-bordered table-hover table-apps">
	<thead>
		<tr>
			<th></th>
			<th>App</th>
			<th style="width: 10px;">Icon</th>
			<th>Slug</th>
			<th>Category</th>
			<th>Descriptions</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($apps as $index => $app)
		<tr>
			<td class="text-center">{{$index + 1}}</td>
			<td><a href="{{ route('apps.show', $app->slug) }}"><b>{{$app->name}}</b></a></td>
			<td class="text-center">
				<i class="{{$app->icon}}"></i>
			</td>
			<td>{{$app->slug}}</td>
			<td>{{$app->category->name}}</td>
			<td>{{$app->descriptions}}</td>
			<td>
				<a href="{{ route('admin.apps.edit', $app->id) }}">
					<i class="fa fa-cog"></i>
				</a>
				<form action="{{ route('admin.apps.destroy', $app->id) }}" method="POST" class="m0 p0 inline">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Xóa nhé')" class="btn-link m0 p0"><i class="fa fa-trash"></i></button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection