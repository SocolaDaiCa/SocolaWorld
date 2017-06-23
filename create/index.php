<!-- gạch dưới giữa các từ -->
<?php
	if (isset($_GET['create-database'])) {
		[
			'hostname' => $hostname,
			'username' => $username,
			'password' => $password
		] = $_GET;

		$conn = new mysqli($hostname, $username, $password, 'facebook');
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Create database</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br>
		<div class="container">
			<div class="col-lg-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"></h3>
					</div>
					<div class="panel-body">
						<form action="" method="GET" role="form">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Hostname</span>
									<input id="hostname" type="text" class="form-control" name="hostname" placeholder="Host name">
								</div>
							</div>
							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Username</span>
									<input id="username" type="text" class="form-control" name="username" placeholder="User name">
								</div>
							</div>
							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Password</span>
									<input id="password" type="password" class="form-control" name="password" placeholder="Password">
								</div>
							</div>
							<button type="submit" name="create-database" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>