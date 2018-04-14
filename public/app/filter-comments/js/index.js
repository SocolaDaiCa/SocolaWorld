/*
 * @Author: Socola
 * @Date:   2018-02-01 20:03:32
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-23 18:00:31
 */
'use strict';
var fb;
var app = new Vue({
	el: '#app',
	data: {
		process: false,
		comments: [],
		condition: '',
		idStatus: ''
	},
	methods: {
		start: function() {
			if (app.process) { return; }
			app.process = true;
			this.reset();
			this.getComments();
		},
		reset: function() {
			this.comments = [];
		},
		getComments: function() {
			let query = 'comments.limit(100){from,message,reactions.limit(0).summary(1)}';
			fb.graph(this.idStatus, query, (listComments) => {
				if (!listComments) { return; }
				listComments.forEach(comment => {
					comment.reactions = comment.reactions.summary.total_count;
					this.comments.push(comment);
				})
				
			}, () => {
				console.log("xong");
				app.process = false;
			}, 'v2.10');
		},
		filter: function(comments) {
			return comments.filter((comment) => {
				// return true;
				return comment.message.search(this.condition) !== -1;
			});
		},
		downloadEmails: function() {
			let listMails = [];
			this.commentsHasMail.forEach(function(comment) {
				listMails.push(comment.mail.join("\n"));
			});
			var file = new File([listMails.join("\n")], "List mails.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		},
		downloadPhones: function() {
			let listPhones = [];
			this.commentsHasPhone.forEach(function(comment) {
				listPhones.push(comment.phone.join("\n"));
			});
			var file = new File([listPhones.join("\n")], "List phones.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		},
		downloadLinks: function() {
			let listLinks = [];
			this.commentsHasLink.forEach(function(comment) {
				listLinks.push(comment.link.join('\n'));
			});
			var file = new File([listLinks.join("\n")], "List links.txt", { type: "text/plain;charset=utf-8" });
			saveAs(file);
		}
	},
	computed: {
		commentsHasMail: function() {
			var comments = [];
			this.comments.forEach((comment) => {
				comment.mail = [];
				getWords(comment).forEach((word) => {
					if (!validateEmail(word)) {
						return;
					}
					comment.mail.push(word);
				});
				comment.mail.length &&  comments.push(comment);
			});
			return comments;
		},
		commentsHasPhone: function() {
			var comments = [];
			this.comments.forEach((comment) => {
				comment.phone = [];
				getWords(comment).forEach((word) => {
					validatePhone(word) && comment.phone.push(word);
				});
				comment.phone.length && comments.push(comment);
			});
			return comments;
		},
		commentsHasLink: function() {
			var comments = [];
			this.comments.forEach((comment) => {
				comment.link = [];
				getWords(comment).forEach((word) => {
					validateUrl(word) && comment.link.push(word);
				});
				comment.link.length && comments.push(comment);
			});
			return comments;
		},
	},
	created: function() {
		fb = new FacebookGraph('../../');
		$.get('/apps/token', function(token) {
			fb.setToken(token);
			fb.checkLiveToken();
		});
	}
});

function getWords(comment) {
	return comment.message.split(/,| |\n/);
}

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