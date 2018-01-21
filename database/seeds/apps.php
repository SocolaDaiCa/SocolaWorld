<?php

use Illuminate\Database\Seeder;

class apps extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $this->call(App::class);
    	$data = [
    		['Auto beep', 'fa fa-commenting-o', 'auto-beep', 'apps', 'Tự động chửi, chửi không ngừng nghỉ.'],
    		['Bot Remind HashTag', 'fa fa-android', 'bot-remind-hashtag', 'group', ''],
    		['Member checker', 'fa fa-search', 'members-checker', 'group', 'Kiểm tra thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không.'],
    		['Get link youtube', 'fa fa fa-youtube', 'get-link-youtube', 'get-link', ''],
    		['Lab calendar', 'fa fa-calendar', 'lab-calendar', 'apps', ''],
    		['Check live Token', 'fa fa-check-circle', 'check-live-token', 'apps', ''],
    		['Giveway Checker', 'fa fa-clone', 'giveway-checker', 'apps', ''],
    		['Encode decode', 'fa fa-code', 'encode-decode', 'apps', 'Url, Base64, md5'],
    		['Clean wall', 'fa fa-eraser', 'delete-all-posts-in-wall', 'profile', 'Xóa toàn bộ bài viết trên tường của bạn.'],
    		['Filter Comments', 'fa fa-filter', 'filter-comments', 'apps', 'Lọc mail, số điện thoại, link từ bình luận.'],
    		['Ranking member', 'fa fa-group', 'ranking-member', 'group', 'Thống kê tương tác, xếp hạng thành viên.'],
    		['Post multiple groups', 'fa fa-keyboard-o', 'post-multiple-groups', 'apps', 'Đăng bài trong nhiều nhóm cùng lúc.'],
    		['Filter post', 'fa fa-newspaper-o', 'filter-posts', 'group', 'Lọc bài viết mới nhất trong nhóm.'],
    		['Get link Shutterstock', 'fa fa-picture-o', 'get-link-shutterstock', 'get-link', ''],
    		['Member checker', 'fa fa-search', 'members-checker', 'group', 'Kiểm tra thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không.'],
    	];

    	foreach ($data as $item) {
    		DB::table('apps')->insert([
	            'name' => $item[0],
	            'icon' => $item[1],
	            'path' => $item[2],
	            'category' => $item[3],
	            'descriptions' => $item[4],
	            'show' => 1
	        ]);

    	}
        
    }
}
