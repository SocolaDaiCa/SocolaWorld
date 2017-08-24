var fb;
var zz = new Vue({
	el: '#app',
	data: {
		idGroup: '',
		listPosts: []
	},
	methods: {
		getListPosts: function() {
			
		}
	}
});
$(function() {
	fb = new FB('./');
	fb.setToken($.cookie('token'));
});