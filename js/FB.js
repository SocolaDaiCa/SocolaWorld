arr_dieu_kien = [
	'from',
	'story',
	'created_time',
	'message',
	'full_picture',
	'type',
	'link',
	'picture',
	'name',
	'description',
	'caption',
	'source',
	'likes.summary(true).limit(0){total_count}',
	'comments.summary(true).limit(0){total_count}',
	'permalink_url',
];
var since = parseInt(Date.now()/1000)-48*3600;
var dk_post = arr_dieu_kien.toString();
var countPost=0;

function FB(path) {
	this.me ={};
	this.link_graph = 'https://graph.facebook.com/';
	this.path_show_error = path;
	this.json ='';
	this.json_string ='';
	/**/
	this.group={};
	this.token =null;
	/**/
	this.getIdFromUrl = function() {
		this.group.id=(document.URL.split('/')).pop();
	};
	this.setId = function(id) {
		this.group.id = id;
	};
	this.setToken = function(){
		$.ajaxSetup( { "async": false } );
		this.token = $.cookie('token') || this.token;
		var json;
		$.getJSON(this.link_graph+'v2.9/me', {access_token : this.token}, 
			function(res) { json = res;});
		this.me = json;
		$.getJSON(this.link_graph+'v2.3/'+this.group.id, {
			fields : 'name',
			access_token : this.token
		}, function(res) { json = res; });
		this.groups = json;
		// if('name' in this.groups)
		// 	document.title = this.groups.name;
		$.ajaxSetup( { "async": true } ); 
	};
	this.setCover = function(){
		$.getJSON(this.link_graph+'v2.9'+'/'+this.group.id, 
			{
				fields       : 'cover',
				access_token : this.token,
			},
			function(json_cover) {
				var url_cover = json_cover.cover.source || '';
				$('.cover').css('background-image', 'url('+url_cover+')');
		});
	};
	this.listGroups = function(){
		var fields = 'groups.limit(50){picture,name,email,icon}';/*{,,privacy,,picture}*/
		this.graph('me', fields, show_list_groups, Null, '');
	};
	this.newsFeed = function(){
		var fields = 'feed.limit(15).since('+since+'){'+dk_post+'}';
		this.graph(this.group.id, fields, showNewsFeed, Null, 'newsfeed');
	};
	this.listMembers = function(id){
		var fields = 'members.limit(500){name,link}';
		this.graph(fields, showListMembers, Null, 'listMenbers');
	};
	this.graphA = function(idTarget, fields){
		$.ajaxSetup( { "async": false } );
		var json;
		$.getJSON('https://graph.facebook.com/v2.3/'+idTarget, 
		{
			fields       : fields,
			access_token : this.token
		},
		function(res) {
			json = res;
		});
		$.ajaxSetup( { "async": true } );
		return json;
	};
	return this;
}
FB.prototype.graph=function(idTarget, fields, action, actionElse, id) {
	var all = this;
	$.getJSON('https://graph.facebook.com/v2.3/'+idTarget, 
	{
		fields       : fields,
		access_token : this.token
	},
	function(res) {
		var field = Object.keys(res)[0];
		var json = res[field].data;
		$('#'+id).html('');
		action(json, all);
		if(res[field].paging && res[field].paging.next)
			return graphNext(res[field].paging.next, action, actionElse, all);
		return actionElse();
	});
};
function graphNext(next, action, actionElse, all){
	$.getJSON(next, function(res) {
		action(res.data, all);
		if(res.paging && res.paging.next)
			return graphNext(res.paging.next, action, actionElse, all);
		return actionElse();
	});
}
function Null() {}

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