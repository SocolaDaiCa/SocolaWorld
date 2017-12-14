<?php
  require_once 'construct.php';
  require_once PATH_LIB . 'phpselector.php';
  require_once PATH_LIB . 'curl.php';

  $csnLogo = 'https://tentstudy.github.io/images/logocsn.jpg';

  function getInIf($data) { 
    return substr($data, stripos($data, 'if'), stripos($data, 'else') - stripos($data, 'if'));
  }

  function getListLinkDownload($data, $name, $singer)
	{
    $data = getInIf($data);
		$list = array();
		$start = $end = 0;
		$start = stripos($data, '<a href="', $start + 9);
    $linkHighQuality = 0; //đếm số link chất lượng cao của bài hát này
    $linkMp3 = 'xxx'; //lưu một link mẫu để gửi kèm khi tải chất lượng cao
		while ($start > -1) {
			$end = stripos($data, 'onmouseover', $start) - 2;
			if ($end - $start > 9) {
				$link = substr($data, $start + 9, $end - $start - 9);
        if (stripos($link, 'login.php') == false) {
          if (count($list) == 2 && $linkHighQuality > 0) break; //không thêm link mobile khi có 2 link thường và cả 
          $startQuality = stripos($link, '[');
          $endQuality = stripos($link, ']');
          $quality = substr($link, $startQuality + 1, $endQuality - $startQuality - 1);
          $item = array(
            'link' => str_replace(' ', '%20', $link),
            'quality' => $quality
          );
          array_push($list, $item);
          if ($linkMp3 == 'xxx') {
            $linkMp3 = $link;
          }
        } else {
          $linkHighQuality++;
        }
			}
			$start = stripos($data, '<a href="', $start + 9);
		}
    if ($linkHighQuality > 0) {
      $name = base64_encode($name);
      $singer = base64_encode($singer);
      $linkMp3 = base64_encode(str_replace(' ', '%20', $linkMp3));
      $link = "https://apps.tentstudy.xyz/csn/highquality.php?n={$name}&s={$singer}&b={$linkMp3}&c={$linkHighQuality}";
      $item = array(
        'link' => str_replace(' ', '%20', $link),
        'quality' => 'Chất lượng cao'
      );
      array_push($list, $item);
    }
    
		return $list;
	}

  $keyword = 'lac+troi';
  $hasInput = 0;
  if (isset($_GET['q']) && strlen(trim($_GET['q'])) > 0) {
    $hasInput = 1;
    $keyword = str_replace(' ', '+', $_GET['q']);
  } else {
    $bot->sendText('Không nhập gì hả, nghe Nạc Chôi nhé');
  }
  $html = cURL('http://search.chiasenhac.vn/search.php?s=' . $keyword);
  $dom = new SelectorDOM($html);
  $links = $dom->select('.tenbh p');

  $listMusic = array();
  $i = 0;
  for ($t = 0; $t < 3 && $i < count($links); $t++) {
    while (stripos('video', $links[$i]['children'][0]['attributes']['href']) > -1) $i+=2;
    $music = array(
      'name' => $links[$i]['text'],
      'singer' => $links[$i + 1]['text'],
      'link' => str_replace('.html', '_download.html', $links[$i]['children'][0]['attributes']['href'])
    );
    array_push($listMusic, $music);
    $i+=2;
  }
  $gallery = array();
  foreach ($listMusic as $music) {
    $downloadPage = cURL($music['link']);
    $downloadDOM = new SelectorDOM($downloadPage);
    $linksDownload = $downloadDOM->select('b script');
    $linksDown = getListLinkDownload($linksDownload[1]['text'], $music['name'], $music['singer']);
    $buttons = array();
    foreach ($linksDown as $link) {
      array_push($buttons, $bot->createButtonToURL($link['quality'], $link['link']));
    }
    array_push($gallery, $bot->createElement($music['name'], $csnLogo, $music['singer'], $buttons));
  }
  if ($hasInput == 1) {
    $num = count($listMusic);
    $bot->sendText("{$_GET['q']} à, em thấy {$num} bài trên top nè");
  }
  $bot->sendGallery($gallery);