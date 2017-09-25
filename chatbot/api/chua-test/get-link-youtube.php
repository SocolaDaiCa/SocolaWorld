<?php
/*
 * https://saveallvideos.com/
 * url https://www.youtube.com/watch?v=HgBBcnAUCfU
 */
	$validate = false;
	// require_once 'define.php';
	require_once 'construct.php';
	require_once PATH_LIB . 'validate.php';
	require_once PATH_LIB . 'simple_html_dom.php';
	function getData($url, $urlYoutube)
	{
		$browser = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.69 Safari/537.36';
		$ch	  = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_USERAGENT, $browser);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "url={$urlYoutube}"); 
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}


	$url = empty($_GET['url']) ? '' : $_GET['url'];
	if(empty($url) || !isURL($url)){
		$text = "Url {$gender} nhập không hợp lệ";
		return $bot->sendText($text);
	}
	
	$buttons = array();
	$data = getData('https://www.saveallvideos.com/infor', $url);
	$html = str_get_html($data);
	// echo($data);
	$nameVideo = $html->find('p', 0)->plaintext;
	$imageVideo = $html->find('img', 0)->src;
	// lấy danh sách video
	$table = $html->find('table', 0);
	// echo $table;
	foreach($table->find('tr') as $index => $tr){
		if($index == 0 || $index > 3){
			continue;
		}
		$quality = $tr->find('td', 0)->plaintext; // chất lượng
		$format  = $tr->find('td', 1)->plaintext; // định dạng
		$size    = $tr->find('td', 2)->plaintext; // kích thước
		$button  = $tr->find('td', 3);
		$linkVideo    = explode('"', $button)[3];
		$linkDownload = HOST . "page/download.php?url={$linkVideo}&name=" . urlencode($nameVideo . " - {$quality}") . "." . strtolower($format);
		$title = "{$quality} {$format} {$size}";
		$buttons[] = $bot->createButtonToURL($title, $linkDownload);
	}

	$title    = $nameVideo;
	$image    = $imageVideo;
	$subTitle = 'Create by https://chatbot.tentstudy.xyz';
	$element  = $bot->createElement($title, $image, $subTitle, $buttons);
	$bot->sendGallery($element);

	// lấy danh sách audio
	$data = getData('https://www.saveallvideos.com/findAudiosLink', $url);
	$html = str_get_html($data);
	// echo($data);
	$buttons = array();
	$table = $html->find('table', 0);
	// echo $table;
	foreach($table->find('tr') as $index => $tr){
		if($index == 0 || $index > 3){
			continue;
		}
		$quality = $tr->find('td', 0)->plaintext; // chất lượng
		$format  = $tr->find('td', 1)->plaintext; // định dạng
		$size    = $tr->find('td', 2)->plaintext; // kích thước
		$button  = $tr->find('td', 3);
		$linkAudio    = explode('"', $button)[1];
		// $linkDownload = HOST . "page/download.php?url={$linkAudio}&name=" . urlencode($nameVideo . " - {$quality}") . "." . strtolower($format);
		$linkDownload = urldecode($linkAudio);
		$title = "{$quality} {$format} {$size}";
		// echo($linkDownload);
		$buttons[] = $bot->createButtonToURL($title, $linkDownload);
	}
	$bot->sendTextCard('Audio', $buttons);
?>