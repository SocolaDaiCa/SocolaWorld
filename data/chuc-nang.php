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
	private $icon;
	private $url;
	private $title;
	private $content;
	public function __construct($icon, $url, $title,  $content)
	{
		$this->icon    = $icon;
		$this->url     = $url;
		$this->title   = $title;
		$this->content = $content;
	}
	public function showForIndex()
	{
		global $col;
		echo"
		<div class=\"col-lg-{$col} col-md-6 text-center\">
			<div class=\"service-box\">
				<a href=\"{$this->url}\" title=\"\">
					<i class=\"{$this->icon} fa-4x\"></i>
				</a>
				<h3><a href=\"{$this->url}\" title=\"\">{$this->title}</a></h3>
				<p class=\"text-muted text-justify\">{$this->content}</p>
			</div>
		</div>
		";
	}
	public function showForNav()
	{
		echo("
		<li><a href=\"{$this->url}\" title=\"\">
				<i class=\"{$this->icon}\"></i>
				{$this->title}
		</a></li>
		");
	}
}
	$chucNang = array();
	// $chucNang[] = new ChucNang(
	// 	'fa fa-group text-primary sr-icons',
	// 	'/app/check-rank',
	// 	'Ranking member',
	// 	'Thống kê tương tác, xếp hạng thành viên.'
	// );
	// $chucNang[] = new ChucNang(
	// 	'fa fa-link text-primary sr-icons',
	// 	'/app/get-link-shutterstock',
	// 	'Get link Shutterstock',
	// 	''
	// );
	$chucNang[] = new ChucNang(
		'fa fa-check-circle text-primary sr-icons',
		'/app/check-live-token',
		'Check live Token',
		''
	);
	$chucNang[] = new ChucNang(
		'fa fa-code text-primary sr-icons',
		'/app/encode-decode',
		'Encode decode',
		''
	);
	$chucNang[] = new ChucNang(
		'fa fa-filter text-primary sr-icons',
		'/app/comments-checker',
		'Comments checker',
		'Lọc mail, số điện thoại và cả link từ bình luận.'
	);
	$chucNang[] = new ChucNang(
			'fa fa-search text-primary sr-icons',
			'/app/members-checker',
			'Member checker',
			'Kiểm tra thành viên thuộc nhóm A nhưng có thuộc nhóm B hay không.'
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
	// chưa check
	// $chucNang[] = new ChucNang(
		// 	'fa fa-search fa-4x text-primary sr-icons',
		// 	'<a href="app/find-my-fb-id/" title="">Find my Facebook ID</a>',
		// 	''
	// );
	// $chucNang[] = new ChucNang(
		// 	' fa-4x text-primary sr-icons',
		// 	'',
		// 	''
	// );
	// $chucNang[] = new ChucNang(
		// 	' fa-4x text-primary sr-icons',
		// 	'',
		// 	''
	// );
	// $chucNang[] = new ChucNang(
		// 	' fa-4x text-primary sr-icons',
		// 	'',
		// 	''
	// );	
?>