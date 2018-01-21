<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta property="fb:app_id" content="1878792532378003" />
		<meta property="og:site_name" content="sfit-utc.tentstudy.xyz" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{$group->name}} Ranking" />
		<meta property="og:description" content="{{$group->name}} Ranking - By The Tien Nguyen" />
		<meta property="og:url" content="https://sfit-utc.tentstudy.xyz/rank.html" />
		<meta property="og:image" content="https://tentstudy.xyz/images/banner_share_fb_short_url.png" />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="300" />
		<meta property="og:image:height" content="300" />
		<meta property="og:locale" content="vi_VN" />
		<title>{{$group->name}} Ranking</title>
		<link rel="shortcut icon" type="image/png" href="https://tentstudy.xyz/images/icons/favicon.png" />
		<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/rank.css')}}">
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">
				{{$group->name}}<br>Ranking Group
				<br> Top {{sizeof($member)}}
			</h1>
			<p class="text-center">
				Total: <b>{{$insight->posts}}</b> posts,
				<b>{{$insight->comments}}</b> comments
				 and <b>{{$insight->reactions}}</b> reactions,
				 <b>{{$insight->member_active}}/{{$insight->member_count}}</b>
				active member. Updated at: {{date('H:i A \n\g\à\y d/m/Y', strtotime($insight->updated_at))}}
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<table class="table table-bordered table-hover" id="table-rank">
						<thead>
							<tr>
								<th></th>
								<th>Username</th>
								<th>Posts</th>
								<th>Comments</th>
								<th>Reactions</th>
								<th>Score</th>
							</tr>
						</thead>
						<tbody>
							@foreach($member as $index => $user)
							<tr>
								<td>{{$index + 1}}</td>
								<td>
									<a href="https://fb.com/{{$user->user_id}}" title="{{$user->user_ame}}">
										<img src="https://graph.facebook.com/{{$user->user_id}}/picture?type=large&redirect=true&width=40&height=40" alt="avatar" class="img-circle">
										{{$user->user_name}}
									</a>
								</td>
								<td>{{$user->posts}}</td>
								<td>{{$user->comments}}</td>
								<td>{{$user->reactions}}</td>
								<td>{{$user->score}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>