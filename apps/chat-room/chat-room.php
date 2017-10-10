<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Chat Room</title>
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" href="css/chat-room.css">
	</head>
	<body>
		<div class="chat-room" id="app">
			<div class="title">
				Chat room
			</div>
			<div class="list-messages">
				<div v-for="message in listMessages">
					<div class="media" v-if="message.userID !== userID">
						<a class="pull-left" href="#">
							<img class="media-object img-circle" :src="'https://graph.facebook.com/'+message.userID+'/picture?type=large&redirect=true&width=40&height=40'" alt="Image">
						</a>
						<div class="media-body">
							<div v-for="message in message.message">
								<span>{{message}}</span>
							</div>
						</div>
					</div>
					<div v-else class="media me">
						<div class="media-body">
							<div v-for="message in message.message">
								<span>{{message}}</span>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div>
				<input  type="text" class="form-control" v-model="message" v-on:keyup.13="sendMessage"></input>
			</div>
		</div>
		<?php require_once '../../layout/js.php'; ?>
		<script src="http://localhost:3000/socket.io/socket.io.js"></script>
		<script src="js/chat-room.js"></script>
	</body>
</html>