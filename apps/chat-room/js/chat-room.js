// gọi điện lên server
'use strict';
var socket = io("http://localhost:3000");

function a() {
    socket.emit("Client-send-info", {
        username: app.username,
        userID: app.userID
    });
}
/*lắng nghe dữ liệu server gửi xuống */
socket.on("Server-send-list-users", function(listUsers) {
    app.listUsers = listUsers;
    console.log("aaa");
})
socket.on("Server-send-data", function(data) {
    app.addMessage(data);
});
var app = new Vue({
    el: "#chat-box",
    data: {
        username: '',
        userID: '',
        listUsers: [],
        message: '',
        listMessages: [],
        listUsers: []
    },
    methods: {
        sendMessage: function() {
            if (!this.message) return;
            console.log(this.message);
            socket.emit("Client-send-data", {
                message: this.message,
                userID: this.userID,
                username: this.username
            });
            this.message = '';
            $('[data-toggle="tooltip"]').tooltip();
        },
        sendImage(image) {
            socket.emit("Client-send-data", {
                userID: this.userID,
                username: this.username,
                img: image
            });
        },
        addMessage: function(data) {
            data.class = "me";
            if (this.userID !== data.userID) data.class = "not-me";
            console.log(data);
            this.listMessages.push(data);
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
    socket.emit("Client-send-info", {
        username: app.username,
        userID: app.userID
    });
});

function auto_grow(element) {
    element.style.height = "10px";
    element.style.height = (element.scrollHeight) + "px";
}

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}
$('#chooseImage').on('change', function uploadFile(e) {
    let file = e.target.files[0];
    getBase64(file).then(
        data => {
        	app.sendImage(data);
        	e.target.files[0] = null;
        }
    );
});