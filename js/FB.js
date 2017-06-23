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
		var token;
		$.get(this.path_show_error+'actionToken.php?action=getToken', 
		function(res) {
				token = res;
		});
		this.token = token || this.token;
		var json;
		$.getJSON(this.link_graph+'v2.9/me', {access_token : this.token}, 
			function(res) { json = res;});
		this.me = json;
		$.getJSON(this.link_graph+'v2.3/'+this.group.id, {
			fields : 'name',
			access_token : this.token
		}, function(res) { json = res; });
		this.groups = json;
		document.title = this.groups.name;
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
		var fields = 'groups.limit(250){icon,name,privacy,email}';
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
	this.graph=function(idTarget, fields, action, actionElse, id) {
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
	return this;
}
function graphNext(next, action, actionElse, all){
	$.getJSON(next, function(res) {
		action(res.data, all);
		if(res.paging && res.paging.next)
			return graphNext(res.paging.next, action, actionElse, all);
		return actionElse();
	});
}
function Null() {}