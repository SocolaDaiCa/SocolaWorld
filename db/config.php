<?php
	define('client_id','425249171186475');
	define('client_secret','1723fe0ec79cd0cf142c93b9010ff5d8');
	if ($_SERVER['HTTP_HOST'] === 'facebook.dev') {
		define('hostName', 'localhost');
		define('username', 'root');
		define('password', '');
		define('databaseName', 'socola_world');
		define('redirect_uri','http://facebook.dev/return.php');
	} else {
		define('hostName', 'localhost');
		define('username', 'tentstud_sfit');
		define('password', '1234567812345678');
		define('databaseName', 'tentstud_sfit');
		define('redirect_uri','https://socola.tentstudy.xyz/return.php');
	}
?>