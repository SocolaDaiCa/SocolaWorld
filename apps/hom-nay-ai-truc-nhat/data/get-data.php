<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>User ID</th>
					<th>UserName</th>
					<th>Url</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "";
				$string = file_get_contents("json.txt");
				$json = json_decode($string);	
				foreach ($json as $user) {
					$sql .="insert into checked VALUES ('{$user->id}', '{$user->name}', '{$user->picture->data->url}', 0);\n";
					echo"
						<tr>
							<td>$user->id</td>
							<td>$user->name</td>
							<td>{$user->picture->data->url}</td>
						</tr>
					";
				}
			?>
			</tbody>
		</table>
		<textarea><?php echo$sql; ?></textarea>
	</body>
</html>