'use strict';
/* danh sách các biến*/
var fb;
var app = new Vue({
	el: '#app',
	data: {
		process: false,
		idStatus: '',
		allComments: [],
		commentsHasMail: [],
		commentsHasPhone: [],
		commentsHasLink: []
	},
	methods: {
		filterComments: function() {
			if (app.process) { return; }
			app.process = true;
			/* xóa dữ liệu trong bảng từ lần lọc bình luận trước*/
			app.clearData();
			/* kiểm tra token trước khi lọc bình luận*/
			/* bắt đầu lọc bình luận*/
			fb.graph(this.idStatus, 'comments.limit(100){from,message,reactions.limit(0).summary(1)}', function showComment(listComments) {
				if (!listComments) { return; }
				listComments.forEach(function(comment) {
					app.addComment(comment);
					app.addIfHasMail(comment);
					app.addIfhasPhone(comment);
					app.addIfhasLink(comment);
				});
			}, function() {
				console.log("xong");
				app.process = false;
			}, 'v2.10');
		},
		addComment: function(comment) {
			comment.reactions = comment.reactions.summary.total_count;
			this.allComments.push(comment);
		},
		addIfHasMail: function(comment) {
			var words = app.getWords(comment);
			/**/
			words.forEach(function(word) {
				if (validateEmail(word)) { // nếu chứa mail thì
					comment.mail = word;
					return app.commentsHasMail.push(comment);
				}
			});
		},
		addIfhasPhone: function(comment) {
			var words = app.getWords(comment);
			words.forEach(function(word) {
				if (validatePhone(word)) { // nếu chứa mail thì
					comment.phone = word;
					return app.commentsHasPhone.push(comment);
				}
			});
		},
		addIfhasLink: function(comment) {
			var words = app.getWords(comment);
			words.forEach(function(word) {
				if (validateUrl(word)) { // nếu chứa link thì
					comment.link = word;
					return app.commentsHasLink.push(comment);
				}
			});
		},
		getWords: function(comment) {
			return comment.message.split(/,| |\n/);
		},
		clearData: function() {
			this.allComments = [];
			this.commentsHasMail = [];
			this.commentsHasPhone = [];
			this.commentsHasLink = [];
		},
		/*download*/
		downloadListEmails: function() {
			let listMails = [];
			this.commentsHasMail.forEach(function (comment) {
				listMails.push(comment.mail);
			});
			var file = new File([listMails.join("\n")], "List mails.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		},
		downloadListPhones: function() {
			let listPhones = [];
			this.commentsHasPhone.forEach(function (comment) {
				listPhones.push(comment.phone);
			});
			var file = new File([listPhones.join("\n")], "List phones.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		},
		downloadListLinks: function() {
			let listLinks = [];
			this.commentsHasLink.forEach(function (comment) {
				listLinks.push(comment.link);
			});
			var file = new File([listLinks.join("\n")], "List links.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		}
	}
});

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function validatePhone(phone) {
	var re = /^\+?([0-9]{2,})\)?[-. ]?([0-9]{2,})[-. ]?([0-9]{2,})$/;
	return re.test(phone);
}

function validateUrl(url) {
	// var re = /^((https?|ftp|file):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	var re = new RegExp('^(https?|ftp|file)(:\\/\\/)?' + // protocol
		'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
		'((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
		'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
		'(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
		'(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
	return re.test(url);
}
$(function() {
	fb = new FB('../../');
	fb.setToken($.cookie('token'));
	fb.checkLiveToken();
});