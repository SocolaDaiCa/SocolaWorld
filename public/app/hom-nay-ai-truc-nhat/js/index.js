'use strict';
const app = new Vue({
	el: '#app',
	data: {
		users: []
	},
	methods: {
		getUsers: function() {
			$.post(`/apps/hom-nay-ai-truc-nhat/${groupID}`, function(users) {
				app.users = users;
			});
		},
		done: function(id) {
			$.post(`/apps/hom-nay-ai-truc-nhat/excute-duty/${id}`, function(users) {
                app.getUsers();
            });
		},
		queue: function(id) {
			$.post(`/apps/hom-nay-ai-truc-nhat/back/${id}`, function(users) {
                app.getUsers();
            });
		}
	},
	created: function() {
		this.getUsers();
	}
});