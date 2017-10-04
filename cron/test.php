<pre>
<?php 
	require_once '../db/connect.php';
	$listBots = $db->query("SELECT group_id,access_token,hashtag from bot_remind_hashtag where active=1 and hashtag!=''");
	// print_r($listBots);
	$listHashTags = $listBots[0][2];
	$arr = explode("\n", $listHashTags); 
	var_dump($arr);
// 	$string = "#sfit_relax 
// Ai đó hãy nói là t nhìn nhầm đi ((;";
// 	$hashtag = "#sfit_relax";
// 	if(strpos($string, $hashtag)!==false){
// 		echo("đây rồi");
// 	} else {
// 		echo("không thấy");
// 	}
?>