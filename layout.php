<?php 
	$text = array(
		'Thống kê tương tác thành viên trong nhóm',
		'thống kê tương tác bạn bè'
	);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>lay out</title>
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<!-- 		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div> -->
			<?php for($i = 0; $i<=10; $i++ ): ?>
			<div class="col-xs-7 col-sm-6 col-md-5 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						Panel content
					</div>
					<div class="panel-footer">
						<?php echo($text[$i]); ?>
					</div>
				</div>
			</div>
			<?php endfor ?>
		</div>
	</body>
</html>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/lib/jquery-3.2.1.min.js"></script>
<script src=""></script>