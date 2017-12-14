<?php
  require_once 'construct.php';
  require_once PATH_LIB . 'curl.php';

  $rss = array(
    'Tin mới nhất' => 'http://vnexpress.net/rss/tin-moi-nhat.rss',
    'Thời sự' => 'http://vnexpress.net/rss/thoi-su.rss',
    'Thế giới' => 'http://vnexpress.net/rss/the-gioi.rss',
    'Giải trí' => 'http://vnexpress.net/rss/giai-tri.rss',
    'Thể thao' => 'http://vnexpress.net/rss/the-thao.rss',
    'Giáo dục' => 'http://vnexpress.net/rss/giao-duc.rss',
    'Số hóa' => 'http://vnexpress.net/rss/so-hoa.rss',
    'Cười' => 'http://vnexpress.net/rss/cuoi.rss'
  );
  $loaiTin = 'Tin mới nhất';
  $urlRss =  'http://vnexpress.net/rss/tin-moi-nhat.rss';

  if (isset($_GET['loaitinvnexpress']) && array_key_exists($_GET['loaitinvnexpress'], $rss)) {
    $urlRss = $rss[$_GET['loaitinvnexpress']];
    $loaiTin = $_GET['loaitinvnexpress'];
  }

  function getDescription($data) {
    // echo htmlentities($data);
    $startUrl = stripos($data, 'src="');
    $endUrl = stripos($data, '"', $startUrl + 6);
    $imgUrl = substr($data, $startUrl + 5, $endUrl - $startUrl - 5);
    $startDes = stripos($data, '</br>', $endUrl);
    $des = substr($data, $startDes + 5, strlen($data) - $startDes - 5);
    return array('imgUrl' => $imgUrl, 'des' => $des);
  }

  $myXMLData = cURL($urlRss);
  $xml=simplexml_load_string($myXMLData, null, LIBXML_NOCDATA) or die($bot->sendText('Không lấy được tin tức'));
  $mangBaiViet = json_decode(json_encode($xml->channel, JSON_PRETTY_PRINT))->item;
  $elems = array();
  for ($i = 0; $i < 3; $i++) {
    $baiVietXML = $mangBaiViet[$i];
    $linkDes = getDescription($baiVietXML->description);
    $baiViet = $bot->createElement(
      $baiVietXML->title,
      $linkDes['imgUrl'],
      $linkDes['des'],
      array(
        $bot->createButtonToURL(
          'Xem ngay',
          $baiVietXML->link  
        )
      )
    );
    array_push($elems, $baiViet);
    
  }
  $bot->sendText('Chủ để: ' . $loaiTin);
  $bot->sendList($elems);
  // $bot->sendTextCard(
  //   'Xem tin tức khác', 
  //   array(
  //     $bot->createButtonToBlock('Có', 'vnexpress'),
  //     $bot->createButtonToBlock('Không', 'Welcome message')
  //   )
  // );