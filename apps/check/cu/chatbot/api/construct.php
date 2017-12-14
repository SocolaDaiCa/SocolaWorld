<?php
	require_once 'define.php';
	require_once PATH_LIB . 'SDK-Php-Chatfuel-Socola.php';
	if(!isset($debug))
		$debug = TRUE;
	if(!isset($validate))
		$validate = true;
	$bot = new Chatfuel($debug, $validate);

	/*default*/
	$gender    = 'bạn';
	$beautiful = '';
	$me        = 'Mình';
	if(!empty($_GET['gender']))
	{
		$gender = $_GET['gender'];
		if($gender === 'male'){
			$gender = 'anh';
			$beautiful = 'đẹp trai';
			$me = 'Em';
		}
		elseif ($gender === 'female') {
			$gender = 'chị';
			$beautiful = 'xinh đẹp';
			$me = 'Em';
		}
	}


?>
