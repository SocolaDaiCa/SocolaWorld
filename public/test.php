<pre>
<?php
	$jsonString = file_get_contents('res.json');
	$json = json_decode($jsonString);
	echo $json[0]->comments->in;
	print_r($json);
?>
</pre>