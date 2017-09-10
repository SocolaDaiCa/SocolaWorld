<?php require '../../check-login.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Check members</title>
		<?php require_once '../../layout/header.php'; ?>
		<?php require_once '../../layout/css.php'; ?>
		<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="members-checker.css">
	</head>
	<body id="app">
		<?php require_once '../../layout/nav.php'; ?>
		<div class="header text-center">
			<h1>Members Checker</h1>
			<p>Kiếm tra 1 thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không</p>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="form-group">
						<span>Nhóm A</span>
						<select  title="Pick a number" class="form-control" id="list-groups-a">
							<option v-for="group in listGroups" data-id-group="{{group.id}}">{{group.name}}</option>
						</select>
					</div>
					<span>Nhóm B</span>
					<div class="form-group">
						<select  title="Pick a number" class="form-control" id="list-groups-b">
							<option v-for="group in listGroups" data-id-group="{{group.id}}">{{group.name}}</option>
						</select>
					</div>
					<div class="form-group">
						<button type="button" v-on:click="start" class="btn btn-primary">Kiểm tra</button>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<!-- Default panel contents -->
						<div class="panel-heading">Kết quả kiếm tra: {{status}}</div>
						<div class="panel-body">
							
						</div>
						
						<!-- Table -->
						<table class="table">
							<thead>
								<tr>
									<th>Thành viên</th>
									<th>Thuộc</th>
								</tr>
							</thead>
							<tbody v-for="member in members.list">
								<tr>
									<td>
										<a href="https://fb.com/{{member.id}}" title="" target="_blank">{{member.name}}</a>
									</td>
									<td><i class="{{member.check}}"></i></td>
									<!-- <td> <i class="fa fa-check-square-o"></i> </td> -->
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php require_once '../../layout/js.php'; ?>
<script src="members-checker.js"></script>