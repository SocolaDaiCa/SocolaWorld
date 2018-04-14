<?php

namespace App\Http\Controllers\Chatbot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socola\Chatfuel;

class Bmi extends Controller
{
    public function index(Request $request)
    {
    	$bot = new Chatfuel;
    	$height = $request['height'];
    	$weight = $request['weight'];


		if(	empty($height) || empty($weight) ||
			!is_numeric($height) || !is_numeric($weight)
		){
			$text = 'Dữ liệu không hợp lệ, không thể tính toán.';
			return $bot->sendText($text);
		}
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
    }
}
