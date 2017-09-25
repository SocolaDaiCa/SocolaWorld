<?php
	define('client_id','425249171186475');
	define('client_secret','1723fe0ec79cd0cf142c93b9010ff5d8');
	if (!empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'facebook.dev') {
		define('hostName', 'localhost');
		define('username', 'root');
		define('password', '');
		define('databaseName', 'socola_world');
		define('redirect_uri','http://facebook.dev/return.php');
	} else {
		define('hostName', 'localhost');
		define('username', 'tentstud_socola_world');
		define('password', 'ORRM6JpFL+ul');
		define('databaseName', 'tentstud_socola_world');
		define('redirect_uri','https://socola.tentstudy.xyz/return.php');
	}
?>