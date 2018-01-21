<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liblary\Graph;
use App\VSBG;
use App\Image;

class VSBGController extends Controller
{
	protected $data = [];
	function __construct()
	{
		
	}
	public function index()
	{
		return view('apps.pages.vsbg', $this->data);
	}
	public function loadMore()
	{
		
	}
	public function crawl($since = '.since(-1 hour)')
	{
		$since = '';
		$timeStart = strtotime('now');
		$fb = new Graph('');
		if(!$fb->isTokenLive()){
			echo "die";
		}
		$vsbg = VSBG::all();
		echo "<ol>";
		foreach ($vsbg as $key => $target) {
			$res = $fb->graph($target->target_id, [
				'fields' => "feed.limit(500){$since}{attachments{media,target}}"
			], function ($data){
				foreach($data as $item){
					if(empty($item->attachments->data)) continue;
					foreach ($item->attachments->data as $key => $attachment) {
						if(empty($attachment->media->image)) continue;
						$src = $attachment->media->image->src;//;
						echo "<li>$src</li>";
						$image = Image::firstOrNew(['url' => $src]);
						$image->category = 'girl';
						$image->level = 3;
						$image->save();
					}
				}
			}, 'feed');
		}
		$timeFinish = strtotime('now');
		$totalTime = $timeFinish - $timeStart;
		echo "hết {$totalTime}";
	}
}
