@extends('admin.layouts.base') @section('content')
<form action="{{$action}}" method="POST" class="form-horizontal" role="form">
	@csrf @method($method)
	<div class="form-group">
		<legend>{{$legend}} Category</legend>
	</div>
	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">Name:</label>
		<div class="col-sm-10">
			<input type="text" name="name" id="inputName" class="form-control" value="{{$category->name ?? old('category' ?? old('name'))}}" required="required" title="Name">
		</div>
	</div>
	<div class="form-group">
		<label for="textareaDescription" class="col-sm-2 control-label">Description:</label>
		<div class="col-sm-10">
			<textarea name="description" id="textareaDescription" class="form-control" rows="3">{{$category->description ?? old('description')}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>
@endsection