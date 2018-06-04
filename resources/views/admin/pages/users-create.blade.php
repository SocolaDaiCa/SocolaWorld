@extends('admin.layouts.base') @section('content')
<form action="{{$action}}" method="POST" class="form-horizontal" role="form">
	<div class="form-group">
		<legend>Form title</legend>
	</div>
	@csrf @method($method)
	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">Name:</label>
		<div class="col-sm-10">
			<input type="text" name="name" id="inputName" class="form-control" value="{{$user->name ?? old('name')}}" required="required" title="">
		</div>
	</div>
	<div class="form-group">
		<label for="inputPermission_id" class="col-sm-2 control-label">Permission_id:</label>
		<div class="col-sm-2">
			<select name="permission_id" id="inputPermission_id" class="form-control" required="required">
				@foreach ($permissions as $permission)
					<option value="{{$permission->id}}" {{$permission->id == $user->permission_id ? 'selected' : ''}}>{{$permission->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>
@endsection