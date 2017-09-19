'use strict';
var fb;
var app = new Vue({
	el: "#app",
	data: {
		listGroups: [],
		keys: {},
		countGroups: 0,
		listBots: []
	},
	methods: {
		getListBots: function() {
			$.getJSON(`https://graph.facebook.com/me/accounts?access_token=${fb.token}`, function(listpages) {
				app.listBots = listpages.data;
				app.listBots.push({
					'name': me.name,
					'access_token': fb.token
				});
			});
		},
		getListGroups: function() {
			fb.graph('me', 'groups.limit(100){name,icon}', function(listGroups) {
				listGroups.forEach(function(group) {
					group.hasBot = false;
					group.listBots = app.listBots;
					app.listGroups.push(group);
					app.keys[`g_${group.id}`] = app.countGroups++;
				});
			}, function() {}, 'v2.3');
		},
		setBot: function(groupId) {
			console.log('ngu');
			// coi như đã ajax
			let index = app.keys['g_' + groupId];
			app.listGroups[index].hasBot = !app.listGroups[index].hasBot;
			console.log(app.listGroups[index].hasBot);
		}
	},
	created: function() {
	}
});
$(function() {
	fb = new FB('./');
		fb.setToken($.cookie('token'));
		fb.checkLiveToken();
		$.ajaxSetup( { "async": false } );
		app.getListBots();
		$.ajaxSetup( { "async": true } );
		
		app.getListGroups();
});