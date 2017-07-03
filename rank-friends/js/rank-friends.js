// var
	var fb, idTargt;
	var end = false;
	var interval;
	var listFriends = null;
	var leng_max = 0;
	var leng_now = 0;
	var leng_last = 0;
	var percent_last = 0;
	var percent_now =0;
	var htmlFriend = 
		'<tr id="{id-friend}">'+
			'<td class="index"></td>'+
			'<td>{name}</td>'+
			'<td>{reaction}</td>'+
			'<td>{comments}</td>'+
			'<td>{score}</td>'+
		'</tr>';
	var htmlPost =
	'<tr>'+
		'<td class="index"></td>'+
		'<td>{id}</td>'+
	'</tr>';
// fun
	function Friend(id, name) {
		this.id       = id;
		this.name     = name;
		this.like     = 0;
		this.comments = 0;
		this.actionLike = function(){
			this.like++;
		};
		this.countLike = function() {
			return this.like;
		};
		this.actionComments = function(){
			this.comments++;
		};
		this.countComments = function() {
			return this.comments;
		};
		return this;
	}
	function showPercent(){
		leng_last=leng_now;
		percent_now = parseInt((leng_last)/leng_max);
		if(percent_last<percent_now)
		{
			percent_last++;
			$('#percent').text(percent_last+"%");
		}
		if(percent_last==percent_now && end===true)
		{
			clearInterval(interval);
			$('#percent').text("100%");
			$('#count-friends').text("bạn bè: "+leng_last+" người.");
		}
	}
	// var name =item.name;
	// var html = htmlFriend
	// 	.replace('{name}', name)
	// 	.replace('{reaction}', 0)
	// 	.replace('{comments}', 0)
	// 	.replace('{score}', 0);
	// $('#result').append(html);
// action list friend
	function actionListFriends(json, all) {
		leng_now += json.length;
		json.forEach(function(item, index) {
			listFriends['_'+item.id] = new Friend(item.id, item.name);
			var name =item.name;
			var html = htmlFriend
				.replace('{id-friend}', '_'+item.id)
				.replace('{name}', name)
				.replace('{reaction}', 'loading...')
				.replace('{comments}', 'loading...')
				.replace('{score}', 'loading...');
			$('#result').append(html);
		});
	}
	function endActionListFriends() {
		end = true;
	}
// action list post
	function actionListPosts(json, all) {
		json.forEach(function(item, id) {
			var html = htmlPost.replace('{id}', item.id);
			$('#result-id-post').append(html);
			fb.graph(item.id, '')
		});
	}

$(function createVar() {
	fb = new FB('../');
	fb.setToken();
	idTargt = '100003751886295';/*'100006472931102'*/
});



$(function() {
	$("#list-friends").click(function() {
		listFriends = {};
		interval = setInterval(showPercent, 50);
		leng_max = fb.graphA(idTargt, 'friends.limit(0)').friends.summary.total_count;
		leng_max/=100;
		console.log(leng_max);
		fb.graph(idTargt, 'friends.limit(500)', actionListFriends, endActionListFriends,'result');
	});

	$('#list-posts').click(function() {
		fb.graph(idTargt, 'posts.since(-30 day).limit(500){id}', actionListPosts, Null, 'result-id-post');
	});

});

