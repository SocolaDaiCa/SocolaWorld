@extends('admin.layouts.base') @section('header') @endsection @section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/apps.css')}}"> @endsection @section('js')
<script src="{{ asset('admin/js/apps.js') }}"></script>
@endsection @section('content')
<table class="table table-bordered table-hover table-apps">
	<thead>
		<tr>
			<th></th>
			<th>App</th>
			<th style="width: 10px;">Icon</th>
			<th>Path</th>
			<th>Categry</th>
			
			<th>Descriptions</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($apps as $index => $app)
		<tr>
			<td class="text-center">{{$index + 1}}</td>
			<td>{{$app->name}}</td>
			<td class="text-center"><i class="{{$app->icon}}"></i></td>
			<td>{{$app->slug}}</td>
			<td>{{$app->category}}</td>
			
			<td>{{$app->descriptions}}</td>
			<td>
				<a href="{{ route('admin.apps.edit', $app->id) }}">
					<i class="fa fa-cog"></i>
				</a>
				<a href="{{ route('admin.apps.destroy', $app->id) }}?_method=delete" onclick="actionDelete()"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection