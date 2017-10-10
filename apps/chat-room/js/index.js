// gọi điện lên server
'use strict';
var socket = io("http://localhost:3000");
$(function() {
    $(".click").click(function() {
        socket.emit("Client-send-data", "haha");
    });
});
/*lắng nghe dữ liệu server gửi xuống */
socket.on("Server-send-data", function(data) {
    $("#data").append(data);
});
var app = new Vue({
    el: "#app",
    data: {
        username: '',
        userID: '',
        listUsers: [],
        message: ''
    },
    methods: {
        sendMessage: function() {
            console.log(this.message);
            this.message = '';
            socket.emit("Client-send-data", {
            	message: 'hihi'
            });
        },
        setData: function() {
            this.username = $.cookie("username");
            this.userID = $.cookie("userid");
        }
    },
    create: function() {

    }
});
$(function() {
    app.setData();
});