<?php
	$fileName = $_GET['filename'] ?? '';
	$data = $_GET['data'] ?? '';
	if(empty($fileName)){
		return;
	}
	$path = "../../{$fileName}";
	if(!empty($data)){
		file_put_contents($data, $path);
	} else {
		echo(file_get_contents($path));
	}
?>