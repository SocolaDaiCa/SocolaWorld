<pre>
</pre>
<!-- getFBId.php?url={url usercần lấy id} -->
<?php
	function viewsource($url)
	{
		$ch = curl_init();
		$timeout = 15;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.69 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	if(!empty($_GET['url'])) $url = $_GET['url'];
	if(!empty($_GET['id']))  $url = "http://facebook.com/{$_GET['id']}";
	$html = viewsource($url);
	$html = explode('content="fb://', $html)[1];
	$id = explode('/', $html)[1];
	// echo(htmlentities($html));
	// $arr_html = explode('fb://profile/', $html);
	// foreach ($arr_html as $key => $value) {
	// 	echo(htmlentities($value).'<br>');
	// }
	// $id = isset($arr_html[1]) ? $arr_html[1] : 'fb méo công khai, k check đc';
	$id = explode('"', $id)[0];
	echo($id);
?>