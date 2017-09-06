<?php
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	function linkProfile($member)
	{
		$color = ($member->id === $member->name) ? 'text-muted' : '';
		echo("<a href=\"https://fb.com/{$member->id}\" class=\"{$color}\" target=\"_blank\">{$member->name}</a>");
	}
	function getIndex($rank)
	{
		if($rank === 0 || $rank === 1 || $rank === 27){
			return '';
		}
		$rank -= 1;
		$rank = $rank % 5;
		switch ($rank) {
			case '1': return 'I';
			case '2': return 'II';
			case '3': return 'III';
			case '4': return 'IV';
			case '0': return 'V';
		}
	}
	require_once __DIR__ . '/db/connect.php';
	$groupId = empty($_GET['groupID']) ? '1796364763915932' : $_GET['groupID'];
	$listName = array(
			'1796364763915932' => 'SFIT - UTC',
			'677222392439615' => 'SFIT - Giao lưu học hỏi'
	);
	$data        = $db->getInsightGroup($groupId);
	$total       = $data['json']->total;
	$listMembers = $data['json']->members;
	$update_time = $data['update_time'];
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<meta property="fb:app_id" content="1878792532378003" />
			<meta property="og:site_name" content="sfit-utc.tentstudy.xyz" />
			<meta property="og:type" content="website" />
			<meta property="og:title" content="<?php echo $listName[$groupId]; ?> Ranking" />
			<meta property="og:description" content="<?php echo $listName[$groupId]; ?> Ranking - By The Tien Nguyen" />
			<!-- <meta property="og:url" content="https://sfit-utc.tentstudy.xyz/rank.html" />
			<meta property="og:image" content="https://tentstudy.xyz/images/banner_share_fb_short_url.png" />
			<meta property="og:image:type" content="image/jpeg" />
			<meta property="og:image:width" content="300" />
			<meta property="og:image:height" content="300" /> -->
			<meta property="og:locale" content="vi_VN" />
			<title><?php echo $listName[$groupId]; ?> Ranking</title>
			<link rel="shortcut icon" type="image/png" href="https://tentstudy.xyz/images/icons/favicon.png" />
			<script src="/js/pace.min.js"></script>
			<link href="/css/pace-theme-minimal.css" rel="stylesheet" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
			<link rel="stylesheet" href="/css/style.css">
			<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
		</head>
		<body>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h1><?php echo $listName[$groupId]; ?> Ranking</h1>
						<p>Total: <strong><?php echo($total->posts) ?></strong> posts, <strong><?php echo($total->comments) ?></strong> comments and <strong><?php echo($total->reactions) ?></strong> reactions, <strong><?php echo("{$total->activeMembers}/{$total->members}") ?></strong> active member. Updated at: <?php echo date('d/m/Y H:i A', $update_time); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6" style="margin: auto;">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="penel-title">
									<span class="glyphicon glyphicon-stats"></span> Rank
								</div>
							</div>
							<table class="table table-hover table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th class="text-center col-xs-2">Rank</th>
										<th class="text-center col-xs-7">Name</th>
										<th class="text-center col-xs-1">Posts</th>
										<!-- <th>Comments</th> -->
										<th class="text-center col-xs-2">Point</th>
										<!-- <th class="text-center col-xs-2">Influential</th> -->
									</tr>
								</thead>
								<tbody>
									<?php foreach ($listMembers as $member): ?>
									<tr>
										<td class="text-left">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/images/rank/<?php echo($member->rank) ?>.png" alt="Rank #1" title="Rank #1" width="32" height="32">
											<?php echo getIndex($member->rank) ?>
										</td>
										<td class="text-left">
											<img src="https://graph.facebook.com/<?php echo($member->id) ?>/picture?type=large&redirect=true&width=40&height=40" alt="" class=".img-circle" width="32" height="32">
											<?php linkProfile($member) ?>
										</td>
										<td class="text-center"><?php echo($member->posts) ?></td>
										<td class="text-center"><?php echo($member->score) ?></td>
										<!-- <td class="text-center">300</td> -->
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<p class="text-center">By <a href="https://www.facebook.com/SocolaDaiCa1997" target="_blank">The Tien Nguyen</a> - <a href="https://facebook.com/TentStudy" target="_blank">TentStudy</a></p>
			</div>
		</body>
	</html>
	<!-- <script src="/vendor/jquery/jquery.min.js"></script> -->
	<!-- <script src="/vendor/bootstrap/js/bootstrap.min.js"></script> -->