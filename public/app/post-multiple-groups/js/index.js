/*
 * @Author: Socola
 * @Date:   2018-02-01 20:03:32
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 06:34:17
 */
'use strict';
var fb;

function auto_grow(element) {
	// element.style.height = "10px";
	element.style.height = (element.scrollHeight) + "px";
}

var app = new Vue({
	el: "#app",
	data: {
		message: '',
		listGroups: [],
		listGroupsWillPost: [],
		query: {
			getListGroups: 'groups.limit(100){name,icon}'
		}
	},
	methods: {
		getListGroups: function() {
			fb.graph('me', app.query.getListGroups, function(listGroups) {
				app.listGroups = app.listGroups.concat(listGroups);
			}, function() {

			}, 'v2.3');
		},
		post: function() {
			if (!app.listGroupsWillPost.length) { return; }
			var message = encodeURI(app.message);
			app.listGroupsWillPost.forEach(function(group) {
				fb.graphAS(group.id + '/feed', `method=post&message=${message}`, 'v2.3');
			});
			console.log('đăng');
		}
	}
});
$(function() {
	fb = new FacebookGraph('./');
	$.get('/apps/token', function(token) {
		console.log(token);
		fb.setToken(token);
		fb.checkLiveToken();
		app.getListGroups();
	});
})