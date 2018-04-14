/*
 * @Author: Socola
 * @Date:   2018-02-01 20:03:32
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 16:45:43
 */
'use strict';
var app = new Vue({
	el: '#app',
	data: {
		running: false,
		chuiTheoStatusId: false,
		chuiTheoUserId: false,
		chuiFriends: true,
		time: {
			total: 0,
			curent: 0
		},
		intervalTime: 10,
		listStatus: '',
		listUsers: '',
		str: {
			listStatusIDs: ''
		}
	},
	methods: {
		start: function() {
			// nếu các thông số k đúng thì khỏi chạy
			if(this.running){
				return;
			}
			if(isNaN(app.intervalTime)){ 
				return alert("Thời gian bạn vừa nhập không phải là số");
			}
			app.intervalTime = Number(app.intervalTime);
			if (app.intervalTime < 0) {
				app.intervalTime = 0;
			}
			// kiểm tra tốc độ
			if(app.intervalTime === 0 && !confirm("Tốc độ bình luận quá nhanh!\nBạn có thể bị khóa bình luận với tốc độ này.\nBạn chắc chắn muốn tiếp tục?")){
				return;
			}
			console.log('Start');
			this.running = true;
			$("#start").addClass("disabled");
			app.chuiTheoStatusId && app.listStatus && app.beepWithlistPosts();
		},
		stop: function () {
			console.log("stop");
			this.running = false;
			$("#start").removeClass("disabled");
		}
		//,
		// beepWithlistPosts: function() {
		// 	let listStatusId = app.listStatus.split("\n");
		// 	listStatusId.forEach(function(statusId) {
		// 		!isNaN(statusId) && app;
		// 	});
		// },
		// beep: function(id) {
		// 	// fb.graphAS(id, );
		// }
	},
	created: function() {

	}

});