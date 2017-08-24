'use strict';
var fb = new FB('./');
var app = new Vue({
	el: '#app',
	data: {
		query: {
			getListGroups: 'groups.limit(100){name,icon}',
			getListMembers: 'members.limit(500)'
		},
		listGroups: [],
		members: {
			total: 0,
			list: [],
			key: {}
		},
		status: ''
	},
	methods: {
		getListGroups: function() {
			fb.graph('me', app.query.getListGroups, function(listGroups) {
				listGroups.forEach(function(group) {
					app.listGroups.push(group);
				});
			}, function() {
				/*end get list groups*/
			}, 'v2.3');
		
		},
		start: function() {
			app.status = 'đang kiểm tra';
			app.resetData();
			app.getListMembersInGroupsA();
		},
		resetData: function() {
			app.members = {
				total: 0,
				list: [],
				key: {}
			};
		},
		getListMembersInGroupsA: function() {
			var groupId = $("#list-groups-a option:selected").attr('data-id-group');
			console.log(groupId);
			fb.graph(groupId, app.query.getListMembers, function(listMembers) {
				listMembers.forEach(function(member) {
					member.check = '';
					app.members.list.push(member);
					app.members.key[`_${member.id}`] = app.members.total++;
				});
			}, function() {
				app.getListMembersInGroupsB();
			}, 'v2.3');
		},
		getListMembersInGroupsB: function() {
			var groupId = $("#list-groups-b option:selected").attr('data-id-group');
			console.log(groupId);
			fb.graph(groupId, app.query.getListMembers, function(listMembers) {
				listMembers.forEach(function(member) {
					if(typeof app.members.key[`_${member.id}`] !== 'undefined'){
						app.members.list[app.members.key[`_${member.id}`]].check = 'fa fa-check-square-o';
					}
				});
			}, function() {
				app.members.list.sort(function (a, b) {

					return a.check.length - b.check.length;
				});
				app.status = 'kiểm tra hoàn tất';
			}, 'v2.3');
		}
	}
});
$(function() {
	fb.setToken($.cookie('token'));
    fb.checkLiveToken();
	app.getListGroups();
});