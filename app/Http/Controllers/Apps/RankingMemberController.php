<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-27 12:51:57
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 06:23:38
 */
namespace App\Http\Controllers\Apps;

use App\Group;
use App\Http\Controllers\AppsController;
use App\Insight;
use App\RankingMember;
use Illuminate\Http\Request;

class RankingMemberController extends AppsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apps.pages.ranking-member-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($groupID)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
