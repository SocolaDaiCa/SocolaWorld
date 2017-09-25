<?php 
/* link: http://62091c52.ngrok.io/API/tao-chu-long.php?me={{me}}&you={{you}}&gender={{gender}}
 */
	$validate = false;
	require_once 'construct.php';
	require_once PATH_LIB . 'convertUnicode.php';
	require_once PATH_LIB . 'curl.php';

	function shortLink($url)
	{
		$shortAPI = "https://short.tentstudy.xyz/api.php";
		$params = array(
				'url' => $url
			);
		$json = getJSON($shortAPI, $params, 'POST');
    if ($json->success) {
		  return $json->url;
    } else {
      return false;
    }
	}
	$i   = ucfirst($_REQUEST['i']);
	$you = ucfirst($_REQUEST['you']);

	$a   = base64_encode($i);
	$b   = base64_encode($you);

	$iSort   = stripUnicode($i)[0];
	$youSort = stripUnicode($you)[0];

	$iSort   = strtoupper($iSort);
	$youSort = strtoupper($youSort);


	if(!in_array($iSort, $ascii) || !in_array($youSort, $ascii)){
		return $bot->sendText("Hiện tại {$me} chỉ hỗ trợ tên Tiếng Việt thôi ạ.");
	}

	$imgUrl = "https://tentstudy.github.io/images/tao-chu-long/{$iSort}_{$youSort}.jpg";
	$encodedImgUrl = base64_encode($imgUrl);
	$slink = shortLink("https://apps.tentstudy.xyz/tao-chu-long/share.php?a={$a}&b={$b}&g=1&l={$encodedImgUrl}");
  if ($slink == false) {
    $slink = "https://apps.tentstudy.xyz/tao-chu-long/error.aspx";
  }
	$linkShare = "https://www.facebook.com/sharer/sharer.php?u={$slink}";
	$title = "{$i} 💛 {$you}";
	$subTitle = 'Created by TentStudyBot';

	$fileNameEncode = base64_encode("{$title}.jpg");
	$urlDowload = "https://apps.tentstudy.xyz/tao-chu-long/download.php?n={$fileNameEncode}&l={$encodedImgUrl}";

	$bot->sendGallery(
		$bot->createElement($title, $imgUrl, $subTitle,
			array(
				$bot->createButtonToURL('Tải về', $urlDowload),
				$bot->createButtonToURL('Chia sẻ', $linkShare)
			)
		)
	);
?>