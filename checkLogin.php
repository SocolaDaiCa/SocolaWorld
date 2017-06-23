<?php
	$fb->setAccess_token($_COOKIE['token']);
	if($fb->checkToken() == false)
		header('Location: '.$fb->getPathShowError());
?>