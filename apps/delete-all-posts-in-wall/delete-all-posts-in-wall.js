'use strict';
var fb;
var app = new Vue({
	el:"#app",
	data: {

	},
	methods: {
		start: function() {
			console.log('ngu');
			fb.graph('me', 'feed.limit(1000){id}', function(listPosts) {
				listPosts.forEach(function(post) {
					fb.graphAS(post.id, 'method=delete', 'v2.3');
				});
			}, function() {}, 'v2.3');
		}
	}
});
$(function() {
	fb = new FB('./');
	fb.setToken($.cookie('token'));
	fb.checkLiveToken();
});