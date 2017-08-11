<!--
	cách dùng
	/getlistdrive.php?url=xxxx
	xxx là url của list drive đã được bật chia sẻ công khai
	url phải có dạng : https://drive.google.com/drive/folders/0B7SQqAArKv47VmhpUUdfMUlsemc
	url có dạng
	https://drive.google.com/open?id=0B7SQqAArKv47VmhpUUdfMUlsemc
	sẽ không hoạt động
	lỗi này đã fix bởi hàm editUrl
 -->
<!--
	nguồn: Nguyễn Anh Tú | J2TEAM Community //fb.com/100008683629377
	link bài viết: www.fb.com//429203710745088
	link down: https://pastebin.com/pM43W8YU
	chỉnh sửa bởi: Socola Đại Ca //fb.com/100006907028797
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Get List Google Drive</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Get List Google Drive</h2>        
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Url</th>
      </tr>
    </thead>
    <tbody>
<?php
function editUrl($url){
	return str_replace('.com/open?id=', '.com/drive/folders/', $url);
}
function curl($url){
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}
function api_drive($url) {
	$html = '';
	$id = explode("/",$url);
	$urlget = "https://www.googleapis.com/drive/v2/files?q=%27$id[5]%27%20in%20parents&maxResults=9999&key=AIzaSyCISllkltIqYjJs35a3mLkJ5iT-awGrNpA";
	$json = curl($urlget);
	$array = json_decode($json,true);
	$item = $array["items"];
	for($i=0;$i<count($item);$i++) {
		$return[$i]['embedLink'] = $item[$i]['embedLink'];
		$return[$i]['title'] = $item[$i]['title'];
		$html .="<tr>
					<td>".$i."</td>
					<td>".$return[$i]['title']."</td>
					<td>".$return[$i]['embedLink']."</td>
				</tr>";
	}
	return $html;
}
$url = $_GET['url'];
$url = editUrl($url);
echo api_drive($url);
?>
      
    </tbody>
  </table>
</div>
</body>
</html>