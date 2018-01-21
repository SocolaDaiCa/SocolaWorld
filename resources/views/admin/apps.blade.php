@extends('admin.layout')
@section('header')
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/apps.css')}}">
@endsection
@section('js')
@endsection
@section('content')
<table class="table table-bordered table-hover table-apps">
	<thead>
		<tr>
			<th></th>
			<th>App</th>
			<th>Path</th>
			<th>Categry</th>
			<th>Descriptions</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($apps as $index => $app)
		<tr>
			<td>{{$index + 1}}</td>
			<td>{{$app->name}}</td>
			<td>{{$app->path}}</td>
			<td>{{$app->category}}</td>
			<td>{{$app->descriptions}}</td>
			<td>
				<a data-toggle="modal" href='#modal-id'><i class="fa fa-cog"></i></a>
				<i class="fa fa-trash"></i>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
				</div>
				<div class="input-group">
					<select name="" id="input1" class="form-control" required="required">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection