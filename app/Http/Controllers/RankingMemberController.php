<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Insight;
use App\Group;
use App\Liblary\Graph;
use App\RankingMember;

class RankingMemberController extends AppsController
{
	protected $data = [];
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		return view('apps.pages.ranking-member', $this->data);
	}
	public function test()
	{
		$groupID = '1';
		RankingMember::where('group_id', $groupID)->delete();
		$data = [];
		$timeStart = strtotime('now');
		echo $timeStart . '<br>';
		$dem = 0;
		for ($i=0; $i < 100000; $i++) { 
			$user = [
				'group_id' => $groupID,
				'user_id' => $i,
				'user_name' => 0,
				'posts' => 0,
				'comments' => 0,
				'reactions' => 0,
				'score' => 0,
			];
			$data[] = $user;
			$dem++;
			if($dem >= 100){
				RankingMember::insert($data);
				$data = [];
				$dem = 0;
			}
		}
		if($dem > 0){
			RankingMember::insert($data);
		}
		echo RankingMember::where('group_id', '1')->count();
		$timeEnd = strtotime('now');;
		echo "<br>" . ($timeEnd - $timeStart) .'<br>';
	}
	public function save(Request $request)
	{
		$users = json_decode($request['users']);
		$groupInfo = json_decode($request['group']);
		$group = Group::firstOrNew(['id' => $groupInfo->id]);
		$group->id = $groupInfo->id;
		$group->name = $groupInfo->name;
		$group->note = '';
		$group->save();

		/* insight*/
		$insight = Insight::firstOrNew(['id' => $groupInfo->id]);
		$insight->posts = $request['posts'];
		$insight->reactions = $request['reactions'];
		$insight->comments = $request['comments'];
		$insight->member_active = $request['memberActive'];
		$insight->member_count = $request['memberCount'];
		$insight->member_top = '';
		$insight->insight = '[]';
		$insight->save();

		RankingMember::where('group_id', $groupInfo->id)->delete();

		$data = [];
		$dem = 0;
		foreach ($users as $key => $user) {
			$x = [
				'group_id' => $groupInfo->id,
				'user_id' => $user->id,
				'user_name' => $user->name ?? 'no name',
				'posts' => $user->posts ?? 0,
				'comments' => $user->comments->out ?? 0,
				'reactions' => $user->reactions->out ?? 0,
				'score' => $user->score ?? 0
			];
			$data[] = $x;
			if(++$dem >= 1000){
				RankingMember::insert($data);
				$data = [];
				$dem = 0;
			}
		}
		if($dem > 0){
			RankingMember::insert($data);
		}
		// return RankingMember::where('group_id', $groupInfo->id)->count();
		return ['success' => true];
		// $json = json_decode($jsonString);
		// $insight = Insight::firstOrNew(['id' => $groupID]);
		// $insight->insight = $jsonString;

	 //    $token = 'EAACW5Fg5N2IBABkb7BMZCGPC5LfZBx8x90B58ZCpe6ijm1emch6fvimwWLa8D7xecYPp97DyZAhi43oqHpZCaQwsY9FpnYpqHqhK3ZBfzHdpV94qZCKp5kNiwDUGPq0p19ZB0D1gWImGnMjTBMptcCxXIr36lvkGorNmbiYlAX8O4hy9jUdr4VNyBTxRl3rX9ZBgZD';
	 //    $fb = new Graph($token);
	 //    /* cập nhật thông tin nhóm*/
	 //    $groupInfo = $fb->graph($groupID);
	 //    print_r($groupInfo);
	 //    $group = Group::firstOrNew(['id' => $groupInfo->id]);
	 //    $group->name = $groupInfo->name;
	 //    $group->save();
	}
	public function rank($groupID)
	{
		$this->data['group'] = Group::find($groupID);
		if(empty($this->data['group'])){
			return view('apps.rank-not-found');
		}
		$this->data['member'] = RankingMember::where('group_id', $groupID)->orderBy('score', 'desc')->take(30)->get();
		$this->data['insight'] = Insight::find($groupID);
		// $this->data['insight'] = Insight::findOrFail($groupID)->insight;
		// $this->data['insight'] = json_decode($this->data['insight'], true);
		// // print_r($this->data['insight']);
		return view('apps.pages.rank', $this->data);
	}
}