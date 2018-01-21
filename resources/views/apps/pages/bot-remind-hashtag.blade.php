@extends('apps.layout')
@section('header')
<title>Bot Remind hashTag</title>
@endsection
@section('js')
<script src="{{asset('app/bot-remind-hashtag/js/index.js')}}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('app/bot-remind-hashtag/css/index.css')}}">
@endsection
@section('content')
<div class="container">
	<i class="fa fa-gear"></i>
	<h1 class="text-center">Bot Remind HashTag</h1>
	<h2 class="text-center">Bots</h2>
	<table class="table table-bordered table-hover table-bots">
		<thead>
			<tr>
				<th></th>
				<th>Bot</th>
				<th>Group</th>
				<th>Hashtags</th>
				<th>Messages</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(index, bot) in bots">
				<td>@{{index + 1}}</td>
				<td><a :href="'https://fb.com/'+bot.groupID" title="" target="_blank">@{{bot.name}}</a></td>
				<td>@{{bot.groupName}}</td>
				<td class="hashtags">
					<template v-for="hashtag in bot.hashtags.split(',')">
						<a :href="'https://fb.com/hashtag/' + hashtag.replace('#', '') + '?source=feed_text&story_id=' + groupID" class="hashtag" target="_blank">@{{hashtag}}</a>
					</template>
				</td>
				<td class="messages"><div>@{{bot.messages}}</div></td>
				<td><a data-toggle="modal" href='#modal-edit-bot'><i class="fa fa-gear"></i></a></td>
			</tr>
		</tbody>
	</table>
	<h2>Groups</h2>
	<table class="table table-bordered table-hover" id="table-groups">
		<thead>
			<tr>
				<th></th>
				<th>Group</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(index, group) in groups">
				<td>@{{index + 1}}</td>
				<td><a :href="'https://fb.com/' + group.id" target="_blank">@{{group.name}}</a></td>
				<td>
					<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Set Bot</a>
				</td>
			</tr>
		</tbody>
	</table>
	<!-- modal edit-bots -->
	<div class="modal fade" id="modal-edit-bot">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">@{{bot.groupName}}</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<div class="input-group-addon">Bot: </div>
						<select class="form-control" required="required">
							<option value=""></option>
						</select>
					</div>
					<div class="form-group">
						<label>Hashtags</label>
						<textarea class="form-control" rows="10" required="required"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection