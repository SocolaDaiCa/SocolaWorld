// var
	var fb, idTargt;
	var post, postLike, postComment, endPost;
	var end = false;
	var interval, intervalPost;
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
		this.getName = function() {
			return this.name;
		};
		this.getId = function() {
			return this.id;
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
			$('#list-posts').click();
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
			$('#result-listfriends').append(html);
		});
	}
	function endActionListFriends() {
		end = true;
	}
// action list post
	function actionLike(json, all) {
		if(!json)
		{
			postLike++;
			return;
		}
		json.forEach(function(item, index) {
			if(listFriends['_'+item.id])
				listFriends['_'+item.id].actionLike();
		});
		postLike++;
	}
	function actionComments(json, all) {
		if(!json)
		{
			postComment++;
			return;
		}
		json.forEach(function(item, index) {
			if(listFriends['_'+item.from.id])
			listFriends['_'+item.from.id].actionComments();
		});
		postComment++;
	}
	function endActionListPosts() {
		endPost = true;
	}
	function actionListPosts(json, all) {
		post+= json.length;
		json.forEach(function(item, id) {
			var html = htmlPost.replace('{id}', item.id);
			$('#result-id-post').append(html);
			var idTarget = (item.id).split('_')[1];
			fb.graph(idTarget, 'likes.limit(250){from{id}}', actionLike, Null, 'null');
			fb.graph(item.id, 'comments.limit(250){from{id}}', actionComments, Null, 'null');
		});
	}
	function showResult() {
		console.log(false);
		if(post===postLike && post===postComment && endPost===true)
		{
			clearInterval(intervalPost);
			$('#result-listfriends').html('');
			console.log(true);
			var arrFriends = [];
			$.each(listFriends, function(i,n) {
    			arrFriends.push(n);
    		});
    		arrFriends.sort(function(a, b){
    			return  (b.countComments()*3+b.countLike()) - (a.countComments()*3+a.countLike());}
    		);
			// var arrKeys = Object.keys(listFriends);
			// var length = Object.keys(listFriends).length;
			// for (var i = 0; i < length; i++) {
			arrFriends.forEach(function(item, index) {
				// item = listFriends[arrKeys[i]];
				var score = item.countLike() + item.countComments()*3;
				var linkProfile = (item.getName()).link('https://fb.com/'+item.getId());
				var html = htmlFriend
					.replace('{id-friend}', '_'+item.getId())
					.replace('{name}', linkProfile)
					.replace('{reaction}', item.countLike())
					.replace('{comments}', item.countComments())
					.replace('{score}', score);
				$('#result-listfriends').append(html);
			});
		}
	}
$(function createVar() {

});



$(function() {
	$("#list-friends").click(function() {
		fb = new FB('../');
		fb.setToken();
		idTarget = $.cookie('userid');
		if(idTarget=='100004399725901')
			idTargt = '100009070121229';/*'100006472931102'*/
		listFriends = {};
		interval = setInterval(showPercent, 20);
		leng_max = fb.graphA(idTargt, 'friends.limit(0)').friends.summary.total_count;
		leng_max/=100;
		console.log(leng_max);
		fb.graph(idTargt, 'friends.limit(500)', actionListFriends, endActionListFriends,'result-listfriends');
	});

	$('#list-posts').click(function() {
		intervalPost = setInterval(showResult, 1000);
		post =0;
		postLike=0;
		postComment=0;
		endPost=false;
		fb.graph(idTargt, 'posts.since(-30 day).limit(500){id}', actionListPosts, endActionListPosts, 'result-id-post');
	});

});

