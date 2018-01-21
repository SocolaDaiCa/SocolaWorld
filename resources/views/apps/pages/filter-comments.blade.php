@extends('apps.layout')
@section('header')
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/filter-comments/css/index.css')}}">
@endsection
@section('js')
<script src="{{asset('app/filter-comments/js/index.js')}}"></script>
<script src="{{asset('vendor/filesaver/FileSaver.min.js')}}" type="text/javascript" charset="utf-8" async defer></script>
@endsection
@section('content')
<div class="container" id="app">
	<!-- input form -->
	<div style="max-width: 600px; margin: auto">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">ID bài viết</span>
				<input type="text" v-model="idStatus" class="form-control" placeholder="Id status" value="100004399725901_874539162702733">
				<span class="input-group-btn">
					<button v-on:click="start" class="btn btn-secondary" type="button">Filter!</button>
				</span>
			</div>
		</div>
	</div>
	<!-- / input form -->
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Toàn bộ bình luận</a></li>
		<li><a data-toggle="tab" href="#menu1">Bình luận chứa Email</a></li>
		<li><a data-toggle="tab" href="#menu2">Bình luận chứa số điện thoại</a></li>
		<li><a data-toggle="tab" href="#menu3">Bình luận chứa link</a></li>
		<li><input type="text" class="form-control" v-model="condition" placeholder="Search"></li>
	</ul>
	<div class="tab-content" id="list-comments">
		<!-- bảng chứa tất cả bình luận -->
		<div id="home" class="tab-pane fade in active">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td></td>
						<th>Usename</th>
						<th>Bình luận</th>
						<th>Reaction</th>
						<th class="min">Trả lời</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(index,comment) in filter(comments)">
						<td>@{{index+1}}</td>
						<td><a href="//com//" title="">@{{comment.from.name}}</a></td>
						<td>@{{comment.message}}</td>
						<td>@{{comment.reactions}}</td>
						<td class="min"><a :href="'//fb.com/'+comment.id" class="btn btn-primary" target="_blank">Trả lời</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- bảng chứa bình luận có mail -->
		<div id="menu1" class="tab-pane fade">
			Nếu có nhiều email, thì mình chỉ lọc ra email đầu tiên tìm được
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td></td>
						<th>Usename</th>
						<th>Bình luận chứa email</th>
						<th>Email tìm thấy <span class="download glyphicon glyphicon-download-alt" v-on:click="downloadListEmails"></span></th>
						<th>Reaction</th>
						<th class="min">Trả lời</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(index, comment) in filter(commentsHasMail)">
						<td>@{{index+1}}</td>
						<td>@{{comment.from.name}}</td>
						<td>@{{comment.message}}</td>
						<td>@{{comment.mail}}</td>
						<td>@{{comment.reactions}}</td>
						<td class="min"><a :href="'//fb.com/'+comment.id" class="btn btn-primary" target="_blank">Trả lời</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- bảng chứa bình luận có số điện thoại -->
		<div id="menu2" class="tab-pane fade">
			Nếu có nhiều số điện thoại trong một bình luận, mình chỉ lọc ra số điện thoại đầu tiên tìm được
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td></td>
						<th>Usename</th>
						<th>Bình luận chứa số điện thoại</th>
						<th>Số điện thoại tìm thấy <span class="download glyphicon glyphicon-download-alt" v-on:click="downloadListPhones"></span></th>
						<th>Reaction</th>
						<th class="min">Trả lời</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(index, comment) in filter(commentsHasPhone)">
						<td>@{{index+1}}</td>
						<td>@{{comment.from.name}}</td>
						<td>@{{comment.message}}</td>
						<td>@{{comment.phone}}</td>
						<td>@{{comment.reactions}}</td>
						<td class="min"><a :href="'//fb.com/'+comment.id" class="btn btn-primary" target="_blank">Trả lời</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- bảng chứa bình luận chứa link -->
		<div id="menu3" class="tab-pane fade">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td></td>
						<th>Usename</th>
						<th>Bình luận chứa số link</th>
						<th>Link tìm thấy <span class="download glyphicon glyphicon-download-alt" v-on:click="downloadListLinks"></span></th>
						<th>Reaction</th>
						<th class="min">Trả lời</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(index, comment) in filter(commentsHasLink)">
						<td>@{{index+1}}</td>
						<td>@{{comment.from.name}}</td>
						<td>@{{comment.message}}</td>
						<td><a v-bind:href="comment.link" title="" target="_blank">@{{comment.link}}</a></td>
						<td>@{{comment.reactions}}</td>
						<td class="min"><a :href="'//fb.com/'+comment.id" class="btn btn-primary" target="_blank">Trả lời</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection