
function showNewsFeed(json, all) {
	var html ='';
	countPost+=json.length;
	json.forEach(function(status, index) {
		if(Date.parse(status.created_time)/1000 < since) return;
		html+='	<div class="post" id="_'+status.id+'">';
		html+='		<div class="header_post">';
		html+='			<div class="avatar">'+showAvatar(status)+'</div>';
		html+='			<div class="story">';
		html+='				<span>'+showStory(status, all.groups)+'</span>';
		html+='<br><a class="text-muted small" target="_blank" href="'+status.permalink_url+'">'+showCreatTime(status.created_time)+'</a>';
		// html+=				dropdown(status.id);
		html+='			</div>';
		html+='		</div>';

		html+='		<div class="body_post">';
		html+=			showMessage(status);
		html+=			showFullPicture(status);
		html+=			showSource(status);
		html+='		</div>';

		html+='		<div class="footer_post">';
		html+='			<div class="action">';
		html+='				<a href="#/">';
		html+='					<span id="'+index+'_like" onclick="like("'+index+'_like")"">';
		html+='						<i class="fa fa-thumbs-up"></i>';
		html+='						<b class="small">Thích</b>';
		html+='					</span>';
		html+='				</a>';
		html+=				'<a href="'+status.permalink_url+'" target="_blank">';
		html+='					<span class="glyphicon glyphicon-comment"></span>';
		html+='					<b class="small">Bình luận</b>';
		html+='				</a>';
		html+=				'<a href="'+status.permalink_url+'" target="_blank">';
		html+='					<span class="glyphicon glyphicon-share-alt"></span>';
		html+='					<b class="small" style="color:;">Chia sẻ</b>';
		html+='				</a>';
		html+='			</div>';
		html+='			<div class="rearction">';
		html+='				<a href="#/" title="" class="text-muted like">'+status.likes.summary.total_count+'</a>';
		html+='				<a href="'+status.permalink_url+'" target="_blank" class="text-muted comment">'+getCountComments(status)+'</a>';
		html+='			</div>';
		html+='		</div>';
		html+='</div>';
	});
	$('#newsfeed').append(html);
}
function getCountComments(status) {
	if (status.comments && status.comments.summary)
		return status.comments.summary.total_count;
	return 'cant count';
}