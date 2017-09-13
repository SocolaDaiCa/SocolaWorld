<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Auto beep</title>
		<?php require '../../layout/header.php'; ?>
		<?php require '../../layout/css.php'; ?>
		<link rel="stylesheet" href="auto-beep.css">
	</head>
	<body id="app">
		<?php require '../../layout/nav.php'; ?>
		<div class="container">
			<div class="checkbox">
				<div class="col-md-3">
					<fieldset>
						<legend>Chọn mục tiêu</legend>
						<label><input type="checkbox" value="">Gặp ai cũng chửi</label>
						<label><input type="checkbox" value="">Chửi tất cả trừ bạn bè</label>
						<label><input type="checkbox" value="">Chửi thằng đăng status</label>
						<label><input type="checkbox" value="">Chửi theo danh sách Status ID:</label>
						<textarea rows="5"></textarea>
						<label><input type="checkbox">Chửi theo danh sách User ID:</label>
						<textarea rows="5"></textarea>
					</fieldset>
				</div>
				<div class="col-md-3">
					<fieldset>
						<legend>Chọn chức năng</legend>
						<label><input type="checkbox" value="">Chửi có văn hóa</label>
						<label><input type="checkbox" value="">CHửi tất cả status trên News Feed</label>
						<label><input type="checkbox" value="">Chửi tất cả Group, Page đã tham gia</label>
						<label><input type="checkbox" value="">Chửi theo số đông</label>
						<label><input type="checkbox" value="">Chửi có chiều sâu</label>
						<label><input type="checkbox" value="">Chửi có Logic</label>
						<label><input type="checkbox" value="">Chửi kiểu trẻ trâu</label>
						<label><input type="checkbox" value="">Chửi theo vùng miền</label>
						<label><input type="checkbox" value="">Chửi đổng</label>
						<label><input type="checkbox" value="">Chửi theo nội dung Status</label>
						<label><input type="checkbox" value="">Tự tìm logic để chửi</label>
					</fieldset>
				</div>
			</div>
		</div>
		<?php require '../../layout/js.php'; ?>
		<script src="auto-beep.js"></script>
	</body>
</html>