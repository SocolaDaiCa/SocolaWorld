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
	app.addMessage(data);
});
var app = new Vue({
	el: "#app",
	data: {
		username: '',
		userID: '',
		listUsers: [],
		message: '',
		listMessages: []
	},
	methods: {
		sendMessage: function() {
			if(!this.message) return;
			console.log(this.message);
			socket.emit("Client-send-data", {
				message: this.message,
				userID: this.userID,
				username: this.username
			});
			this.message = '';
		},
		addMessage: function (data) {
			if(this.listMessages.length){
				let lastMessage = this.listMessages[this.listMessages.length - 1];
				if(lastMessage.userID === data.userID){
					this.listMessages[this.listMessages.length - 1].message.push(data.message);
					return;
				}
			}
			data.message = [data.message];
			this.listMessages.push(data);
			console.log(JSON.stringify(this.listMessages));
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
function auto_grow(element) {
    element.style.height = "10px";
    element.style.height = (element.scrollHeight)+"px";
}