<?php
	session_start();
	require_once './lib/FB.php';
	require_once './lib/function.php';
	$fb = new FB('./');
	$fb->setAccess_token($_COOKIE['token']);
	require_once 'checkLogin.php';
?>
<?php $time_start = strtotime("now"); ?>
<!DOCTYPE html>
<html lang="vn">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Socola Timeline</title>
		<!-- Latest compiled and minified CSS & JS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/giao_dien.css">
		<script src="js/socola.js"></script>
		<script src="js/FB.js"></script>
		<style>
			.zz{
				box-shadow: 0px 0px 10px 1px #888888;
			}
			a, a:hover{display: block; text-decoration: none; color: black;}
		</style>
	</head>
	<body>
		<?php //require_once 'menubar.php'; ?>
		<div class="container" style="max-width: 800px; padding: 0px; padding-top: 60px;">
			<?php
				// $json = $fb->graph('me', 'groups.limit(100){icon,name,privacy,email}')->groups;
			?>
			<div class="btn-group">
				<a href="locMailComments" class="btn btn-default" target="_blank">Lọc Mail từ Comment</a>
				<a href="tool/check-token" class="btn btn-default">Check Live Token</a>
				<a href="logout.php" class="btn btn-default">Logout</a>
			</div>
			<br><br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nhóm</th>
						<th style="width: 1px;"></th>
						<th>Rank</th>
					</tr>
				</thead>
				<tbody id="listGroups">	
				</tbody>
			</table>
			<!-- <a href="<?php //echo($fb->link); ?>">link graph</a> -->
			<!-- <br>số nhóm <?php //echo(sizeof($json->data)); ?><br> -->
			
		</div>
		<script>
			function show_list_groups(json, all) {
				json.forEach(function(item, inex) {
					item.email = item.email.split('@')[0];
					$('#listGroups').append(
						'<tr>'+
							'<td>'+
								('<img src="'+item.icon+'" alt="">  '+
								item.name).link('groups/'+item.email+'/'+item.id)+
							'</td>'+
							'<td style="width: 1px;">'+getPrivacy(item.privacy)+'</td>'+
							'<td>s</td>'+
						'</tr>'
					);
				});
			}
			function getPrivacy(privacy) {
				switch(privacy){
					case 'OPEN': 
						return'<i class="fa fa-globe text-primary" aria-hidden="true"></i>';
					case 'CLOSED':
						return '<i class="fa fa-unlock-alt text-success" aria-hidden="true"></i>';
					case 'SECRET':
						return '<i class="fa fa-lock text-danger" aria-hidden="true"></i>';
					default: 
						return privacy;
				}
			}
			$(function() {
				var fb = new FB('./');
				fb.setToken();
				fb.listGroups();
			});
		</script>
	</body>
</html>
<?php
	// function showPrivacy($privacy)
	// {
	// 	switch ($privacy) {
	// 		case 'OPEN': echo('<i class="fa fa-globe" aria-hidden="true"></i>'); break;
	// 		case 'CLOSED': echo('<i class="fa fa-lock" aria-hidden="true"></i>'); break;
	// 		default: echo($privacy);
	// 	}
		
	// }
?>