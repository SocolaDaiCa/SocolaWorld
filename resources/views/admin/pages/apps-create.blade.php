@extends('admin.layouts.base') @section('content')
<form action="{{$route}}" method="POST" class="form-horizontal" role="form">
	{{csrf_field()}}
	<div class="form-group">
		<legend>{{$action}} App</legend>
	</div>
	<input type="hidden" name="_method" value="{{$method}}" />
	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">Name:</label>
		<div class="col-sm-10">
			<input type="text" name="name" id="inputName" class="form-control" value="{{$app->name or old('name')}}" required="required" placeholder="Apps Name">
		</div>
	</div>
	<div class="form-group">
		<label for="textareaDescription" class="col-sm-2 control-label">Description:</label>
		<div class="col-sm-10">
			<textarea name="description" id="textareaDescription" class="form-control" rows="3" placeholder="Description">{{$app->description or old('description')}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="inputCategory_id" class="col-sm-2 control-label">Category:</label>
		<div class="col-sm-2">
			<select name="category_id" id="inputCategory" class="form-control" required="required">
				@foreach ($categorys as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<label for="inputIcon" class="col-sm-2 control-label">Category:</label>
		<div class="col-sm-2">
			<input type="text" name="icon" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>
@endsection