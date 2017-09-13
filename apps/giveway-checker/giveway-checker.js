'use strict';
var fb;
var app = new Vue({
	el: '#app',
	data: {
		idStatus: '1415868188670784_1972412866349644',
		listComments: '',
	},
	methods: {
		filterComments: function() {
			app.resetData();
			fb.graph(app.idStatus, 'comments.limit(1000){from,message,message_tags}', function(listComments) {
				app.listComments = app.listComments.concat(listComments);
				console.log(listComments);
				// listComments.forEach(function(comments) {
				// 	// console.log(comments);

				// });
			}, function() {
				
			}, 'v2.3');
		},
		resetData: function() {
			app.listComments = [];
		}
	},
	created: function() {
		fb = new FB('./');
		fb.setToken($.cookie('token'));
		fb.checkLiveToken();
	}
});
$(function() {
	app.filterComments();
})