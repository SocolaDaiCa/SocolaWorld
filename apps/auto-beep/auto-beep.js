'use strict';
var app = new Vue({
    el: '#app',
    data: {
        chuiTheoStatusId: false,
        chuiTheoUserId: false,
        chuiFriends: true,
        time: 1,
        intervalTime: 10,
        listStatus: '',
        listUsers: ''
    },
    methods: {
        start: function() {
            // nếu các thông số k đúng thì khỏi chạy
            if(isNaN(app.intervalTime)){ return console.log('dữ liệu sai');}
            app.intervalTime = Number(app.intervalTime);
            if (app.intervalTime < 0) {
                app.intervalTime = 0;
            }
            // kiểm tra tốc độ
            if(app.intervalTime === 0 && !confirm("Tốc độ bình luận quá nhanh!\nBạn có thể bị khóa bình luận với tốc độ này.\nBạn chắc chắn muốn tiếp tục?")){
                return;
            }



            console.log('Start');
        	app.chuiTheoStatusId && app.listStatus && app.beepWithlistPosts();
        },
        beepWithlistPosts: function() {
        	let listStatusId = app.listStatus.split("\n");
            listStatusId.forEach(function(statusId) {
                !isNaN(statusId) && app
            });
        },
        beep: function(id) {
            // fb.graphAS(id, );
        }
    },
    created: function() {

    }

});