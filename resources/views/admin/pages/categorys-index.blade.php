@extends('admin.layouts.base') @section('header') @endsection @section('css') @endsection @section('js')
<script src="{{asset('admin/js/categorys.js')}}"></script>
@endsection @section('content')
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Category</th>
			<th>Total Apps</th>
			<th>Description</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($categories as $key => $category)
		<tr>
			<td>{{$key + 1}}</td>
			<td>
				<a href="{{ route('admin.categories.show', $category->id) }}"><b>{{$category->name}}</b></a>
			</td>
			<td>{{$category->apps->count()}}</td>
			<td>{{$category->description}}</td>
			<td><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-gear"></i></a>
				<form action="{{ route('admin.categories.destroy', $category->id) }}" class="inline p0 m0" method="POST">
					@csrf @method('DELETE')
					<button type="submit" class="m0 p0 btn-link">
						<i class="fa fa-trash"></i>
					</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection