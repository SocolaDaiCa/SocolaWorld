@extends('admin.layouts.base')
@section('header')
@endsection
@section('css')
@endsection
@section('js')
<script src="{{asset('admin/js/categorys.js')}}"></script>
@endsection
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th></th>
			<th>Category</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($categorys as $key => $category)
			<tr>
				<td>{{$key + 1}}</td>
				<td>{{$category->name}}</td>
				<td>{{$category->description}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection