<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-07 23:18:20
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-28 20:10:32
 */
namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
	protected $gender;
	protected $beautiful;
	protected $me;
	function __construct()
	{
		$request = new Request;
		$this->gender    = 'bạn';
		$this->beautiful = '';
		$this->me        = 'Mình';
		if(!empty($_GET['gender']))
		{
			if($gender === 'male'){
				$this->gender = 'anh';
				$this->beautiful = 'đẹp trai';
				$this->me = 'Em';
			}
			elseif ($gender === 'female') {
				$this->gender = 'chị';
				$this->beautiful = 'xinh đẹp';
				$this->me = 'Em';
			}
		}
	}
    public function welcome(Request $request)
    {
		$first_name = $request['first_name'];
		$last_name = $request['last_name'];
		$text = [
			"Chào {$this->gender} {$last_name} {$first_name} {$this->beautiful} <3 .",
			"{$this->me} có thể giúp gì cho {$this->gender} không ạ."
		];
		$bot->sendText($text);
    }
    public function sleepyTime(Request $request)
    {
    	$timezone = $request['timezone'];
		$time = strtotime("{$timezone} hour");
		$now = date("H:i A", $time);
		$time += 15*60; /*15p đánh răng*/
		$date[0] = date("H:i A", $time + 1.5*3600);
		$date[1] = date("H:i A", $time + 3.0*3600);
		$date[2] = date("H:i A", $time + 4.5*3600);
		$date[3] = date("H:i A", $time + 7.5*3600);

		$text = array();
		$text[] = "Bây giờ là {$now}. Nếu {$this->gender} đi ngủ ngay bây giờ, {$this->gender} nên cố gắng thức dậy vào một trong những thời điểm sau: \n {$date[0]}, {$date[1]}\n hoặc {$date[2]},\n hoặc {$date[3]},\n (Thức dậy giữa một chu kỳ giấc ngủ khiến {$gender} cảm thấy mệt mỏi, nhưng khi thức dậy vào giữa chu kỳ tỉnh giấc sẽ làm {$this->gender} cảm thấy tỉnh táo và minh mẫn.)\n";
		$text[] = "Chúc {$this->gender} ngủ ngon!";
		$bot->sendText($text);
    }
}
