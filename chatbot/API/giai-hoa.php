<?php 
	require_once 'construct.php';
	require_once '../lib/curl.php';
	require_once '../lib/simple_html_dom.php';
	
	$q = $_REQUEST['q'];
	$q = str_replace('	', '+', $q); /*change tab to +*/
	$q = str_replace(' ', '+', $q);  /*change space to +*/
	while(strpos($q, '++') != false)
		$q = str_replace('++', '+', $q); /*remove double +*/
	$q = urlencode($q);

	$url = "http://chemequations.com/en/?s={$q}&k=1";
	$html = str_get_html(cURL($url));

	$arrTexts = array(
		"Theo các chất phản ứng:\n",
		"Theo sản phẩm:\n"
	);
	foreach($html->find('table[class=table search-results]') as $key => $element){
		foreach ($element->find('tr') as $tr) {
			$td = $tr->find('td', 1);
			$phuongTrinh = $td->plaintext;
			$phuongTrinh = str_replace('&rarr;', '→', $phuongTrinh);
			$arrTexts[$key] .= $phuongTrinh . "\n";
		}
	}
	$bot->sendText($arrTexts);
?>