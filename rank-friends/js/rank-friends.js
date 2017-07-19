'use strict';
var fb;
var idTarget;
var queryGetCountFriends = 'friends.limit(0)';
var queryGetFriends = 'friends.limit(1000)';
var queryGetPosts = 'posts.since(-30 day).limit(200){id,from}';

function fngetCountFriends() {
    var leng_maxs = fb.graphA(idTarget, queryGetCountFriends).friends.summary.total_count;
    return leng_maxs;
}
function getIdTarget(id) {
	return id;
}
$(function() {
    fb = new FB('../');
    fb.setToken();
    idTarget = $.cookie('userid');
    if (idTarget === '100004399725901'){
        idTarget = '100003751886295'; /*'100006472931102'*/
    } 
});