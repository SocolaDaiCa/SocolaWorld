<?php 
	require_once 'construct.php';

	if(	empty($_GET['height']) ||
		empty($_GET['weight']) ||
		!is_numeric($_GET['height']) ||
		!is_numeric($_GET['weight']) ){
		$text = 'Dữ liệu không hợp lệ, không thể tính toán.';
		return $bot->sendText($text);
	}

	$height = $_GET['height']; /*cm*/
	$weight = $_GET['weight']; /*kq*/
	
	$result = $weight / ( pow($height / 100, 2) );
	$result = round($result, 2); /*làm tròn 2 số*/

	if($result < 18.5){
		$msg = 'bạn hơi ốm.';
	} elseif ($result < 23) {
		$msg = 'bạn có thân hình thật cân đối.';
	} elseif ($result < 25) {
		$msg = 'bạn sắp béo phì.';
	} elseif ($result < 30) {
		$msg = 'bạn đang bị béo phì.';
	} else {
		$msg = 'bạn quá béo mất rồi.';
	}

	$text = "BMI = {$result}, $msg";
	$bot->sendText($text);
?>
