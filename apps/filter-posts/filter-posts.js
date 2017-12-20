'use strict';
var fb;
var app = new Vue({
	el: '#app',
	data: {
		since: new Date().getTime() - 36 * 3600 * 1000,
		groupId: '364997627165697',
		groupName: '',
		listGroups: [],
		listPosts: [],
		query: {
			getListGroups: 'groups.limit(100){name,icon}',
			getListPosts: 'feed.since(-2 days).limit(15){id,from,message,permalink_url,full_picture,created_time,comments.summary(true){total_count}}'
		}
	},
	methods: {
		start: function(groupId) {
			console.log(groupId);
			if (groupId) {app.groupId = groupId;}
			app.listGroups.forEach(function(group) {
				if(app.groupId === group.id){
					app.groupName = group.name;
					return;
				}
			});
			app.clearData();
			app.getListPosts();
		},
		clearData: function() {
			app.listPosts = [];
		},
		getListGroups: function() {
			fb.graph('me', app.query.getListGroups, function(listGroups) {
				listGroups.forEach(function(group) {
					app.listGroups.push(group);
				});
			}, function() {
				/*end get list groups*/
				app.listGroups.forEach(function(group) {
					if(app.groupId === group.id){
						app.groupName = group.name;
						return;
					}
				});
			}, 'v2.3');
		},
		getListPosts: function() {
			fb.graph(app.groupId, app.query.getListPosts, function(listPosts) {
				if (!listPosts) {return;}
				listPosts.forEach(function(post) {
					if(new Date(post.created_time).getTime() < app.since){ return;}
					post.created_time = app.showCreatTime(post.created_time);
					app.listPosts.push(post);
				});
			}, function() {

			}, 'v2.3');
		},
		showCreatTime: function(created_time) {
			var timeNow = new Date();
			var timeSince = new Date(created_time);
			var timeFor = (timeNow.getTime() / 1000) - (timeSince.getTime() / 1000);
			if (timeFor < 60) {
				return 'Vừa xong';
			}
			if (timeFor < 3600) {
				return parseInt(timeFor / 60) + ' phút';
			}
			if (timeFor < 86400) {
				return parseInt(timeFor / 3600) + ' giờ';
			}
			var stringTime = '';
			if (timeFor - timeNow.getHours() * 3600 - timeNow.getMinutes() * 60 - timeNow.getSeconds() < 86400) {
				stringTime += 'Hôm qua ';
			} else {
				stringTime += timeSince.getDate() + ' tháng ' + (timeSince.getMonth() + 1) + ' ' + timeSince.getFullYear();
			}
			stringTime += ' lúc ' + timeSince.getHours() + ':' + timeSince.getMinutes();
			return stringTime;
		}
	}
});
$(function() {
	fb = new FB('./');
	fb.setToken($.cookie('token'));
	app.getListGroups();
	// app.getListPosts();
});