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
		<div id="chat-box">
			<div id="header">
				<!-- online {{listUsers.length}} -->
			</div>
			<div id="content">
				<template v-for="message in listMessages">
				<div :class="message.class">
					<small>{{message.username}}</small>
					<span>{{message.message}}</span>
					<img :src="message.img" alt="">
				</div>
				<div class="clear"></div>
				</template>
			</div>
			<div id="footer">
				<input  type="text" class="form-control" v-model="message" v-on:keyup.13="sendMessage"></input>
				<div>
					<label for="" class="custom-file">
						<input type="file" id="chooseImage" hidden="hidden" accept="image/*" class="custom-file-input">
						<i class="fa fa-picture-o custom-file-control"></i>
					</label>
				</div>
			</div>
		</div>
		<?php require_once '../../layout/js.php'; ?>
		<script src="http://localhost:3000/socket.io/socket.io.js"></script>
		<script src="js/chat-room.js"></script>
	</body>
</html>