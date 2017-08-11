<?php 
	$login = '<a href="login.html">Đăng nhập</a>';
	$logout = '';

	if(!empty($_COOKIE['token'])){
		$usename = $_COOKIE['username'];
		$logout = '
		<a href="logout.php">
			<i class="fa fa-sign-out"></i>
			Log out</a>';
		$login = "
			<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">{$usename}
				<span class=\"caret\"></span>
			</a>
			<ul class=\"dropdown-menu\">
				<li>{$logout}</li>
			</ul>";
	}

$col = 3;
class ChucNang
{
	private $title;
	private $url;
	private $content;
	public function __construct($icon, $title,  $content)
	{
		$this->icon    = $icon;
		$this->title   = $title;
		$this->content = $content;
	}
	public function show()
	{
		global $col;
		echo"
            <div class=\"col-lg-{$col} col-md-6 text-center\">
                <div class=\"service-box\">
                    <i class=\"{$this->icon}\"></i>
                    <h3>{$this->title}</h3>
                    <p class=\"text-muted text-justify\">{$this->content}</p>
                </div>
            </div>
		";
	}
}
	$chucNang = array();
	$chucNang[] = new ChucNang(
		'fa fa-4x fa-group text-primary sr-icons',
		'<a href="app/check-rank">Ranking member</a>',
		'Thống kê tương tác, xếp hạng thành viên.'
	);
	// $chucNang[] = new ChucNang(
	// 	'fa fa-4x fa-paper-plane text-primary sr-icons',
	// 	'Xếp hạng bạn bè',
	// 	'Thống kê tương tác bạn bè.'
	// );
	// $chucNang[] = new ChucNang(
	// 	'fa fa-4x fa-newspaper-o text-primary sr-icons',
	// 	'<a href="bai-viet-gan-day.php">Bài viết gần đây</a>',
	// 	'Cập nhật tin tức mới nhất của một nhóm hoặc trang.'
	// );
	// $chucNang[] = new ChucNang(
	// 	'fa fa-4x fa-heart text-primary sr-icons',
	// 	'<a href="app/an-link">Ẩn link</a>',
	// 	'Ẩn link, chống ninja, chống xem chùa.'
	// );
	// $chucNang[] = new ChucNang(
	// 	'',
	// 	'<a href="app/filter-comments">Lọc bình luận</a>',
	// 	''
	// );



	// đã check
	$chucNang[] = new ChucNang(
		'fa fa-link fa-4x text-primary sr-icons',
		'<a href="app/get-link-shutterstock">Get link Shutterstock</a>',
		''
	);
	$chucNang[] = new ChucNang(
		'fa fa-check-circle fa-4x text-primary sr-icons',
		'<a href="app/check-live-token">Check live Token</a><br>',
		''
	);
	$chucNang[] = new ChucNang(
		'fa fa-code fa-4x text-primary sr-icons',
		'<a href="app/encode-decode">Encode decode</a><br>',
		''
	);
	$chucNang[] = new ChucNang(
		'fa fa-filter fa-4x text-primary sr-icons',
		'<a href="app/filter-comments/" title="">Filter comments</a>',
		'Thống kê bình luận, lọc mail, số điện thoại từ bình luận'
	);
	// chưa check
	// $chucNang[] = new ChucNang(
	// 	'fa fa-search fa-4x text-primary sr-icons',
	// 	'<a href="app/find-my-fb-id/" title="">Find my Facebook ID</a>',
	// 	''
	// );
	$chucNang[] = new ChucNang(
		' fa-4x text-primary sr-icons',
		'',
		''
	);
	$chucNang[] = new ChucNang(
		' fa-4x text-primary sr-icons',
		'',
		''
	);
	$chucNang[] = new ChucNang(
		' fa-4x text-primary sr-icons',
		'',
		''
	);
	$chucNang[] = new ChucNang(
		' fa-4x text-primary sr-icons',
		'',
		''
	);
	
?>