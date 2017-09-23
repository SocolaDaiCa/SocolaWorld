<?php require_once '../../check-login.php'; ?>
<!DOCTYPE html>
<html lang="vn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Bot Remind hashTag</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" href="bot-remind-hashtag.css">
	</head>
	<body id="app">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Group</th>
						<th>Bot Name</th>
						<th>Bot</th>
						<th>Hashtag</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(key, group) in listGroups">
						<td>{{$index + 1}}</td>
						<td><a href="//fb.com/{{group.id}}" target="_blank">{{group.name}}</a></td>
						<td>
							<select v-model="group.bot" v-on:change="saveBot(group.id)" class="form-control" required="required">
								<option v-for="(key, bot) in listBots" v-bind:value="key">{{bot.name}}</option>
							</select>
						</td>
						<td>
							<button type="button" class="btn btn-danger" v-on:click="setBot(group.id)" v-show="!group.active">Set bot</button>
							<button type="button" class="btn btn-success" v-on:click="removeBot(group.id)" v-show="group.active">Remove bot</button>
						</td>
						<td class="text-center">
							<a class="btn btn-primary" data-toggle="modal" href='#modal-id' v-on:click="editHashtag(key)"><i class="fa fa-paint-brush"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
			<div>
				<div class="modal fade" id="modal-id">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Hashtag</h4>
							</div>
							<div class="modal-body">
								<textarea name="" v-model="hashTag"></textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="saveHashtag">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once '../../layout/js.php'; ?>
		<script src="bot-remind-hashtag.js"></script>
	</body>
</html>