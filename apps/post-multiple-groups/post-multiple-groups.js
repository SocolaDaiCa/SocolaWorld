'use strict';
var fb;
function auto_grow(element) {
    // element.style.height = "10px";
    element.style.height = (element.scrollHeight)+"px";
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
			if (!app.listGroupsWillPost) {return;}
			var message = encodeURI(app.message);
			app.listGroupsWillPost.forEach(function(group) {
				fb.graphAS(group.id + '/feed', `&method=post&message=${message}`, 'v2.3');
				
			});
			console.log('đăng');
		}
	}
});
$(function () {
	fb = new FB('./');
	fb.setToken($.cookie('token'));
	fb.checkLiveToken();
	app.getListGroups();
})