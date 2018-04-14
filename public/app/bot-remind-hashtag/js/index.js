/*
 * @Author: Socola
 * @Date:   2018-02-01 20:03:32
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-23 17:52:20
 */
'use strict';
var fb = new FacebookGraph('./');
var app = new Vue({
	el: "#app",
	data: {
		groups: [],
		bots: [
			
		],
		tokens: [],
		bot: {
			name: 'Socola',
			groupName: 'Socola World',
			groupID: ''
		}
	},
	methods: {
		getGroups: function() {
			fb.graph('me', 'groups.limit(1000){name,icon}', (listGroups) => {
				this.groups = listGroups;
			}, function() {}, 'v2.3');
		},
		getBots: function() {

		},
		// getHashTag: function(hashtag) {

		// }
	},
	created: function() {
		$.get('/apps/token', (token) => {
			fb.setToken(token);
			fb.checkLiveToken();
			this.getGroups();
			// this.getBots();
		});
		for(let i = 1; i<=10; i++){
			this.bots.push({
				name: 'Socola World',
				groupName: 'Jinx',
				groupID: 'me',
				hashtags: '#s1,#s2,#s3',
				messages: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod reprehenderit dolores placeat magnam laborum quas ut? Eaque facere, doloremque veritatis.'
			});
		}
		this.getBots();
	},
});
$(function() {
	// $("#modal-edit-bot").modal();
});