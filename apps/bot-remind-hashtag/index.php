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
						<th>Messages</th>
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
							<a class="btn btn-primary" data-toggle="modal" href='#modal-edit-hashtag' v-on:click="editHashtags(key)"><i class="fa fa-paint-brush"></i></a>
						</td>
						<td><a class="btn btn-primary" data-toggle="modal" href='#modal-edit-message' v-on:click="editMessages(key)"><i class="fa fa-paint-brush"></i></a></td>
					</tr>
				</tbody>
			</table>
			<!-- list modal -->
			<div id="list-modal">
				<!-- modal edit hashtag -->
				<div class="modal fade" id="modal-edit-hashtag">
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
								<button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="saveHashtag">Save HashTag</button>
							</div>
						</div>
					</div>
				</div>
				<!-- modal edit message -->
				<div class="modal fade" id="modal-edit-message">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Messages - {{modal2.groupName}}</h4>
							</div>
							<div class="modal-body">
								<textarea name="" v-model="messages"></textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="saveMessages">Save Messages</button>
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