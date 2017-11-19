<?php
	require_once 'Controller/Controller_User.php';
	$cUser = new Controller_User;
	$login = $cUser->isLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SamSung lab - calendar</title>
		<?php require_once 'Views/css.php'; ?>
		<link rel="stylesheet" href="public/css/calendar.css">
	</head>
	<body>
		<?php require_once 'Views/nav.php'; ?>
		<div class="container" id="app">
			<table class="table table-bordered table-hover table-calendar">
				<thead>
					<tr>
						<th>Ca</th>
						<th v-for="day in calendar">{{day.day}}<br>{{day.date}}</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="ca in 5">
						<td>{{ca+1}}</td>
						<td v-for="day in calendar">
							<div v-for="ca in day.calendar[ca]">
								{{ca[0]}}
							</div>
							<button v-if="day.calendar[ca].length < 4" type="button" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#myModal" v-on:click="set(ca+1, day.day, day.date)">Đăng ký ngay</button>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- Modal -->
			<?php if ($login): ?>
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Đăng kí ca {{ca}}  {{day}} {{date}}</h4>
						</div>
						<div class="modal-body">
							{{res}}
							<p>Lý do đăng ký</p>
							<textarea v-model="lydo" name="" id="input" class="form-control" rows="3" required="required"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">Đăng ký</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php else: ?>
			
			<?php endif ?>
			
		</div>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/vue/vue.min.js"></script>
		<script src="public/js/calendar.js"></script>
		<script src=""></script>
		<script src=""></script>
	</body>
</html>