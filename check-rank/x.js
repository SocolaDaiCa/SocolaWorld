var col        = {};
col.post       = 3;
col.like       = 4;
col.comment    = 5;
col.hasLike    = 6;
col.hasComment = 7;
function USER(name) {
	this.name       = name;
	this.post       = 0;
	this.like       = 0;
	this.comment    = 0;
	this.share      = 0;

	this.hasLiked   = 0;
	this.hasComment = 0;
	this.hasShare   = 0;

	this.actionPost       = function() {this.post++;};
	this.actionLike       = function() {this.like++;};
	this.actionComment    = function() {this.comment++;};
	this.actionShare      = function() {this.share++;};

	this.actionHasLike    = function(count) {this.hasLike+= count;};
	this.actionHasComment = function(count) {this.hasComment+= count;};
	this.actionHasShare   = function(count) {this.hasShare+= count;};
}
var countMembers = 0;
var listUsers = {};
var fb;

var postSince = parseInt(Date.now()/1000)-7*24*3600;

function showListMembers(json, all) {
	var html = '';
	json.data.forEach(function(item, index) {
		$('#listMenbers').append(
		'<tr id="_'+item.id+'">'+
		'	<td></td>'+
		'	<td> <a href="//fb.com/'+item.id+'" target="_blank">'+item.name+'</a></td>'+
		'	<td>'+item.id+'</td>'+
		'	<td>0</td>'+
		'	<td>0</td>'+
		'	<td>0</td>'+
		'	<td>0</td>'+
		'	<td>0</td>'+
		'</tr>');
		++countMembers;
		listUsers[item.id] = new USER(name);
	});
	// $('#listMenbers').append(html);
	// $.post('../save-members.php', {
	// 	json: JSON.stringify(json), 
	// 	groupId: all.group.id
	// }, function(res) {
	// 	console.log(res);
	// });
	// $("html, body").animate({ scrollTop: $(document).height() }, 0);
}
function endShowListMembers() {
	console.log(countMembers);
	console.log(Object.keys(listUsers).length);
}

function actionLike(json, all) {
	if(!json.data) return;
	json.data.forEach(function(item, index) {
		listUsers[item.id].actionLike();
		$('#_'+item.id).children('td').eq(4).text(listUsers[item.id].like);
	});
}

function actionComment(json, all) {
	console.log(json);
	return;
	// if(json.data.length===0) return;
	// console.log('ngu');
	// listUsers[item.from.id].actionHasComment();
	json.data.forEach(function(item, index) {
		listUsers[item.from.id].actionComment();
		$('#_'+item.from.id).children('td').eq(col.comment).text(listUsers[item.from.id].comment);
	});
}

function showListPost(json, all) {
	json.data.forEach(function(item, index) {
		$('#listPosts').append('<tr><td></td><td>'+item.id+'</td></tr>');
		listUsers[item.from.id].actionPost();
		$('#_'+item.from.id).children('td').eq(col.post).text(listUsers[item.from.id].post);
		fb.graph(item.id, 'from,comments.summary(true).limit(100).since('+postSince+'){from{id}}', actionComment, Null);
		// fb.graph(item.id, 'from,likes.summary(true).limit(100).since('+postSince+'){from{id}}', actionLike, Null);
	});
	// $("html, body").animate({ scrollTop: $(document).height() }, 0);
}

$(function() {

	$('#getListMembers').click(function() {
		fb.graph(fb.group.id, 'members.limit(200){id,name}', showListMembers, endShowListMembers);
	});

	$('#getRankMembers').click(function() {
		fb.graph(fb.group.id, 'feed.limit(100).since('+postSince+'){id,from{id}}', showListPost, Null);
	});

	$('[sort]').click(function() {
		var table = $('#listMenbers').children('tr');
		// console.log(table);
		var tg;
		console.log(table.length);
		var col = $(this).attr('sort'); 
		for (var i = 0; i < table.length -1; i++) {
			for (var j = i+1; j < table.length; j++) {
				if($(table[i]).children('td').eq(col).text() < $(table[j]).children('td').eq(col).text())
				{
					console.log('ngu');
					tg = table[i];
					table[i] = table[j];
					table[j] = tg;
				}
			}
		}
		// table.sort(function(a, b){
		// 	console.log($(a).children('td').eq(col).text());
		// 	return $(a).children('td').eq(col).text() < $(b).children('td').eq(col).text();
		// });
		$('#listMenbers').html(table);
	});

	fb = new FB('../../');
	fb.getIdFromUrl();
	$('body').append(fb.id);
	fb.setToken();
	// $('#btnGraphMember').click(function() {
	// $.ajaxSetup( { "async": false } );
	
	// $.ajaxSetup( { "async": true } );
	// 
	// });
});