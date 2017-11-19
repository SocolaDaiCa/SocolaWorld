<pre>
<?php
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$dayofweek = date('w', strtotime("+2 day"));

	print_r($dayofweek);
	echo("<br>");
	print_r(date("l", strtotime("+2 day")));
?>