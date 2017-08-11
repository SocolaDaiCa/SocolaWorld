<?php 
	session_start();
	session_destroy();
	setcookie('token',  $_POST['token'], time() - 5184000);
	header('Location: ./');
?>