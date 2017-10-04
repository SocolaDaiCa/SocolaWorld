<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Add Group Calendar</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
	</head>
	<body id="app">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="container">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Group</th>
						<th>Create Calendar</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="group in listGroups">
						<td><a href="//fb.com/{{group.id}}" target="_blank">{{group.name}}</a></td>
						<td><a href="action/add-user.php?groupID={{group.id}}" class="btn btn-primary" target="_blank">Create Calendar</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php require_once '../../layout/js.php'; ?>
		<script src="js/add-group-calendar.js"></script>
	</body>
</html>