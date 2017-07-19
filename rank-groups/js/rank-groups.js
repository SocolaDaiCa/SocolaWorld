'use strict';
var fb;
var idTarget;
var queryGetCountFriends = 'members.limit(0).summary(true)';
var queryGetFriends = 'members.limit(500)';
var queryGetPosts = 'feed.since(-7 day).limit(200){id,from}';
var type = 'members';
function fngetCountFriends() {
	var leng_maxs = fb.graphA(idTarget, queryGetCountFriends).members.summary.total_count;
    return leng_maxs;
}
function getIdTarget(id) {
	return id/*.split('_')[1]*/;
}
$(function() {
    fb = new FB('../');
    fb.setToken();
    idTarget = $.cookie('userid');
    if (idTarget === '100004399725901'){
        idTarget = '1173636692750000'; /*'100006472931102'*/
        /*386768301412902 java*/
        /*364997627165697 j2*/
        /*173636692750000 VSBG*/
    } 
});
