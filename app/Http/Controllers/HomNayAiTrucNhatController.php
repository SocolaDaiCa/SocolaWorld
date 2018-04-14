<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:29
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-28 20:10:56
 */
namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Liblary\Graph;
use App\Duty;
use App\Group;
class HomNayAiTrucNhatController extends Controller
{
	protected $data = [];
	function __construct()
	{
		
	}
	public function get($groupID)
	{
		$res = Duty::select(
			DB::raw('id, user_id, user_name, counter')
		)->where('group_id', $groupID)->orderBy('counter', 'ASC')->get();
		return $res;
	}
	public function index($groupID)
	{
		$group = Group::where('id', $groupID)->firstOrFail();
		$this->data['groupID'] = $group->id;
		$this->data['groupName'] = $group->name;
		return view('apps.pages.hom-nay-ai-truc-nhat', $this->data);
	}
	public function crawl($groupID)
	{
		$token = 'EAACW5Fg5N2IBABL0n2YXEMgZBXqrsTGXm5qZCK7mJSMH3RrZCOiUsJ0lFccCnsFHGBfxznP6x3gltPDb5Dt7eb8FGExHmplVaB9aemxpBZCuC9xYba2FB88jB4oIsjpKaS1ZB9KAiLfQuzHYSOQ7CElwfrfGfkqzDRtpTznsJB9Egl5DsOZA7kE6KyYo0v4YwqSJivcIK2cAZDZD';
		$fb = new Graph($token);
		/* cập nhật thông tin thành viên */
		$members = $fb->graph($groupID, ['fields' => 'members.limit(1000)'])->members->data;
		foreach ($members as $member) {
			$duty = Duty::firstOrNew([
				'group_id' => $groupID,
				'user_id' => $member->id
			]);
			$duty->user_name = $member->name;
			$duty->save();
		}
		/* cập nhật thông tin nhóm*/
		$groupInfo = $fb->graph($groupID);
		$group = Group::firstOrNew(['id' => $groupInfo->id]);
		$group->name = $groupInfo->name;
		$group->save();
	}

	public function excuteDuty($id, $i = 1)
	{
		$duty = Duty::find($id);
		$duty->counter = max($duty->counter + $i, 0);
		$duty->save();
	}

	public function back($id)
	{
		$this->excuteDuty($id, -1);
	}
}