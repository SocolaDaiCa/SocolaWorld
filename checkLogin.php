<?php
	if(empty($_COOKIE['token']))
		header('Location: '.$fb->getPathShowError());
	$fb->setAccess_token($_COOKIE['token']);
	if($fb->checkToken() == false)
		header('Location: '.$fb->getPathShowError());
?>