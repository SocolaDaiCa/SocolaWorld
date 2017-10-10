<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Chat room - Socola Đại Ca</title>
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div class="wrapper">
			<!-- <div class="input-group">
						<input type="text" name="" id="u" class="form-control" value="" required="required" pattern="" title="">
			</div> -->
			
		</div>
		<div id="app">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<div class="btn-group-vertical">
					<!-- <a class="btn btn-default" vfor="user in listUsers">{{user.name}}</a> -->
				</div>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<div class="list-messages">
					{{username}} - {{userID}}
				</div>
				<div class="send-text">
					<input type="text" class="form-control" v-model="message" required="required" pattern="" v-on:keyup.13="sendMessage">
				</div>
			</div>
		</div>
		<?php require_once '../../layout/js.php'; ?>
		<script src="http://localhost:3000/socket.io/socket.io.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>