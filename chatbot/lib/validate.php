<?php 
	function isURL($url){
		return filter_var($url, FILTER_VALIDATE_URL);
	}


?>