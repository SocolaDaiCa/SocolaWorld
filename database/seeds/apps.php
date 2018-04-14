<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-26 17:47:47
 */
use App\Models\App;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class apps extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
            'Auto beep|fa fa-commenting-o|1|Tự động chửi, chửi không ngừng nghỉ.',
            'Bot Remind HashTag|fa fa-android|3|',
    		'Get link youtube|fa fa fa-youtube|2|',
    		'Lab calendar|fa fa-calendar|1|',
    		'Check live Token|fa fa-check-circle|1|',
    		'Giveway Checker|fa fa-clone|1|',
    		'Encode decode|fa fa-code|1|Url, Base64, md5',
    		'Clean wall|fa fa-eraser|4|Xóa toàn bộ bài viết trên tường của bạn.',
    		'Filter Comments|fa fa-filter|1|Lọc mail, số điện thoại, link từ bình luận.',
    		'Ranking member|fa fa-group|3|Thống kê tương tác, xếp hạng thành viên.',
    		'Post multiple groups|fa fa-keyboard-o|1|Đăng bài trong nhiều nhóm cùng lúc.',
    		'Filter post|fa fa-newspaper-o|3|Lọc bài viết mới nhất trong nhóm.',
    		'Get link Shutterstock|fa fa-picture-o|2|',
    		'Member checker|fa fa-search|3|Kiểm tra thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không.',
    	];

    	foreach ($data as $value) {
            $value = explode('|', $value);
            $app = new App;
            $app->name = $value[0];
            $app->icon = $value[1];
            $app->slug = Str::slug($value[0]);
            $app->category_id = $value[2];
            $app->description = $value[3];
            $app->show = 1;
            $app->save();
    	}
        
    }
}
