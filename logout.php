<?php 
	session_start();
	session_destroy();
	// unset($_SESSION['token']);
	setcookie('token',  $_POST['token'], time() - 5184000);
	echo('ngu');
	header('Location: ./');
?>