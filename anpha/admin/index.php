<?php
	require '../lib/DBconnect.php';
	$records_per_page = 10;
	$curent_page = empty($_GET['page']) ? 1 : $_GET['page'];
	$result = $conn->query("SELECT count(id) as total_records FROM token");
	$total_records = $result->fetch_assoc()['total_records'];
	$total_pages = ceil($total_records / $records_per_page);
	$record_start = ($curent_page - 1) * $records_per_page;
	$result = $conn->query("SELECT * FROM token LIMIT $record_start, $records_per_page");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="../css/socola.css">
		<link rel="stylesheet" href="css/admin.css">
	</head>
	<body>
		<div class="container">
			<table class="table table-condensed table-hover admin">
				<thead>
					<tr>
						<th class="id">id</th>
						<th class="name">Name</th>
						<th class="token">Token</th>
						<th class="action">Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php while( $record =  $result->fetch_assoc() ): ?>
					<tr>
						<td class="id">
							<div class="text crop"><?php echo($record['id']); ?></div>
						</td>
						<td class="name">
							<div class="text crop"><?php show_user($record); ?></div>
						</td>
						<td class="token">
							<div class="text crop"><?php echo($record['token']); ?></div>
						</td>
						<td class="action">
							<span class="label label-success">Copy token</span>
							<span class="label label-danger">Xóa</span>
						</td>
					</tr>
					<?php endwhile ?>
				</tbody>
			</table>
			<ul class="pager">
				<?php
					if($curent_page > 1)
						echo("<li><a href='#'>Trang trước</a></li>");
					if($total_pages <=5)
					{
						for ($i=1; $i <= $total_pages; $i++) { 
							echo("<li><a href='#'>$i</a></li>");
						}
					}
					if($total_pages > 1)
						echo("<li><a href='#'>Trang sau</a></li>");
					else
						echo("<li class='disabled'><a href='#'>Trang sau</a></li>");
				?>
			</ul>
		</div>
	</body>
</html>
<?php 	$conn->close(); ?>
<?php
function show_user($record)
{
	$id   = $record['id'];
	$name = $record['name'];
	echo("<a href='https://fb.com/$id' target='_blank'><img src='https://graph.facebook.com/{$id}/picture?type=large&redirect=true&width=40&height=40' class=''img-circle' alt=''> $name</a>");
}
?>