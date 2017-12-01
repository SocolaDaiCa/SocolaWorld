<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Girl</title>
		<?php require_once __DIR__ . '/../../Views/layout/header.php'; ?>
		<?php require_once __DIR__ . '/../../Views/layout/css.php'; ?>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<?php
			require_once __DIR__ . '/../../Model/Model_Girl.php';
			$mGirl = new Model_Girl;
			$images = $mGirl->getImages();
		?>
		<?php foreach ($images as $image): ?>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 zz">
			<img src="<?php echo $image->src ?>" class="image" align="top">
		</div>
		<?php endforeach ?>
	</body>
</html>