<?php
error_reporting(0);
function gettoken()
{
	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: graph.nhaccuatui.com';
	$headers[] = 'Connection: Keep-Alive';
	
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, "https://graph.nhaccuatui.com/v1/commons/token");
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($c, CURLOPT_POST, 1);
	curl_setopt($c, CURLOPT_POSTFIELDS, "deviceinfo=%7B%22DeviceID%22%3A%22dd03852ada21ec149103d02f76eb0a04%22%2C%22DeviceName%22%3A%22AppTroLyBeDieu%22%2C%22OsName%22%3A%22WINDOWS%22%2C%22OsVersion%22%3A%228.0%22%2C%22AppName%22%3A%22NCTTablet%22%2C%22AppTroLyBeDieu%22%3A%221.3.0%22%2C%22UserName%22%3A%220%22%2C%22QualityPlay%22%3A%22128%22%2C%22QualityDownload%22%3A%22128%22%2C%22QualityCloud%22%3A%22128%22%2C%22Network%22%3A%22WIFI%22%2C%22Provider%22%3A%22NCTCorp%22%7D&md5=ebd547335f855f3e4f7136f92ccc6955&timestamp=1499177482892");

	$page = curl_exec($c);
	curl_close($c);
	
	$infotoken = json_decode($page);
	$token = $infotoken->data->accessToken;
	return $token;
}

function getlink($idbaihat,$token)
{
	//echo $idbaihat;
	$linklist = 'https://graph.nhaccuatui.com/v1/songs/'.$idbaihat.'?access_token='.$token;
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $linklist);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

	$page = curl_exec($c);
	curl_close($c);
	
	$data = json_decode($page);
	return $data;
}
	require_once 'construct.php';
	require_once PATH_LIB . 'validate.php';

	$url = '';
	if(!empty($_GET['url'])){
		$url = $_GET['url'];
	}

	if(!isURL($url)){
		$text = 'Url bạn nhập vào không hợp lệ';
		return $bot->sendText($text);
	}

	$token = gettoken();
	if($token == ""){
		$text = "Lỗi tạo token rồi {$gender} ạ.";
		return $bot->sendText($text);
	}

	$temp = explode(".",$url);
	$idbaihat = trim($temp[3]);

	if($idbaihat == ""){
		$text = "{$me} không thể xác định id bài hát từ id mà {$gender} đã nhập vào.";
		return $bot->sendText($text);
	}

	$data = getlink($idbaihat,$token);
	$linkplay = $data->data->{7};
	$link128 = $data->data->{11};
	$link320 = $data->data->{12};
	$linklossless = $data->data->{19};
	$thumbnail = $data->data->{8};
	$tenbaihat = $data->data->{2};
	$casy = $data->data->{3};

	if($tenbaihat == ""){
		$text = "{$me} không thể get bài này.";
		$bot->sendText($text);
	}

	$buttons = array();
	$buttons[] = $bot->createButtonToURL('128 kbps', $link128);
	$buttons[] = $bot->createButtonToURL('320 kbps', $link320);
	$buttons[] = $bot->createButtonToURL('Lossless', $linklossless);
	$text = "{$tenbaihat} - {$casy}";
	$bot->sendTextCard($text, $buttons);

	$buttons = array();
	$buttons[] = $bot->createButtonQuickReply("Get tiếp", "get-link-nhaccuatui");
	$buttons[] = $bot->createButtonQuickReply("Để khi khác",'huong-dan');
	$text = "Get nữa không {$gender}";
	$bot->sendQuickReply($text, $buttons);
?>
