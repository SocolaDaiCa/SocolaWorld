<?php
	if ($_SERVER['HTTP_HOST'] === 'facebook.dev') {
		define('hostName', 'localhost');
		define('username', 'root');
		define('password', '');
		define('databaseName', 'socola_world');
	} else {
		define('hostName', 'localhost');
		define('username', 'tentstud_sfit');
		define('password', '1234567812345678');
		define('databaseName', 'tentstud_sfit');
	}
?>