<?php
/**
 * Code by Nguyen Huu Dat - https://www.facebook.com/dl2811
 * Code được chia sẻ miễn phí tại J2TEAM Community - https://www.facebook.com/groups/j2team.community
 * 
 * 
 */
//demo code get link 4share.vn không cần tài khoản VIP :D
error_reporting(0);

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}


function getlink($url)
{
	//có thể tạo nhiều acc để random Free để hạn chết bị block acc
	$acc = array(
	//array("acc","pass"),
	array("datnh","123456")
	);
//giờ lấy tài khoản free mình mới đăng ký
	
	
	$dem = count($acc);
	$ngaunhien = rand(0,$dem-1);
	$user = $acc[$ngaunhien][0];
	$pass = $acc[$ngaunhien][1];	  


	$temp = explode("/f/", $url);
	$temp2 = explode("/", $temp[1]);
	$idfile = $temp2[0];
	$idfile4share = trim($idfile);
	if($idfile4share !="")
	{
		$code = base64_encode("!@T#r#o#l#y#f#a#c#e#b#o#o#k#.#c#o#m#@!/$user/$pass/$idfile4share/download.rar");
		$linkget = ("https://4share.vn/tool/?dlfile=".$code);

		$headers2 = array();
		$headers2[] = 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13C75 Safari/601.1';
		$headers2[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$headers2[] = 'Accept-Language: en-US,en;q=0.5';
		$headers2[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $linkget);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers2);
		$repo = curl_exec($c);
		curl_close($c);
		
		preg_match("/<direct_link>(.*)<\/direct_link>/", $repo, $output_link);
		$linkd = $output_link[1];

		preg_match("/<filename>(.*)<\/filename>/", $repo, $output_file);
		$tenfile = $output_file[1];

		preg_match("/<size>(.*)<\/size/", $repo, $output_size);
		$size = formatBytes(trim($output_size[1]));
		
		if($linkd !="")
		{
			$data['err'] = 0;
			$data['linkd'] = $linkd;
			$data['tenfile'] = $tenfile;
			$data['size'] = $size;
			
		}
		else
		{
			$data['err'] = 1;
			$data['msg'] = "ahihi! Die cmnr !";
		}
		
	}
	else
	{
		$data['err'] = 1;
		$data['msg'] = "Không tin thấy ID. Link không hợp lệ!";
		
	}
	
	return $data;
}

	require_once 'construct.php';
	$data = getlink($_GET['url']);
	if(empty($data)){
		return $bot->sendText('Lỗi {$gender} ạ.');
	}

	if($data['err'] === 1){
		$texts = array();
		$texts[] = $_GET['url'];
		$texts[] = "Đã xảy ra lỗi:";
		$texts[] = $data['msg'];
		return $bot->sendText($texts);
	}
	/* chắc hết lỗi rồi*/
	$urlMaxSpeed = $data['linkd'];

	$title = "Download";
	$url = $urlMaxSpeed;
	$buttonDownload = $bot->createButtonToURL($title, $url);

	$text = "link của {$gender} đã được chuẩn bị xong:";
	$bot->sendTextCard($text, $buttonDownload);
?>