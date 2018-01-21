@extends('admin.layout')
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
			<th>Descriptions</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<tr v-for="(category, index) in categorys">
			<td></td>
		</tr>
	</tbody>
</table>
@endsection