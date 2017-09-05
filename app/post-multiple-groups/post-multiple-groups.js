'use strict';
var fb;
function auto_grow(element) {
    // element.style.height = "10px";
    element.style.height = (element.scrollHeight)+"px";
}

var app = new Vue({
	el: "#app",
	data: {
		listGroups: [],
		query: {
			getListGroups: 'groups.limit(100){name,icon}'
		}
	},
	methods: {
		getListGroups: function() {
			fb.graph('me', app.query.getListGroups, function(listGroups) {
				// console.log(listGroups);
				listGroups.forEach(function(group){
					console.log(group);
					app.listGroups.push(group);
				});
			}, function() {
				
			}, 'v2.3');
		}
	}
});
$(function () {
	fb = new FB('./');
	fb.setToken($.cookie('token'));
	fb.checkLiveToken();
	app.getListGroups();
})