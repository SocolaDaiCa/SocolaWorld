@extends('apps.layout') @section('content')
<div class="container">
	<h1 class="text-center">Short Link</h1>
	<form class="col-lg-10 col-lg-offset-1">
		<div class="input-group input-group-lg">
			<input type="text" class="form-control" placeholder="Search">
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit">
					Short
				</button>
			</div>
		</div>
	</form>
</div>
@endsection