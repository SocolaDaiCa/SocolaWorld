'use strict';
/*import { User, Users } from './user.js';*/
var fb;
var users = new Users();
var icon = {
	loading: 'fa fa-spinner fa-spin',
	endload: 'fa fa-check-circle text-success'
};
var app = new Vue({
	el: '#app',
	data: {
		saving: false,
		timeStart: 0,
		timeEnd: 0,
		score: {
			post: 1,
			comment: 1,
			like: 1,
			love: 1,
			haha: 1,
			wow: 1,
			sad: 1,
			angry: 1
		},
		running: false,
		groups: [],
		groupsID: '',
		members: {
			list: users,
			active: 0,
			total: '?'
		},
		users: [],
		since: '',
		query: {},
		icon: {
			members: '',
			post: '',
			postHasScanComments: '',
			postHasScanReaction: '',
			comments: '',
			reactions: ''
		},
		count: {
			posts: 0,
			comments: 0,
			reactions: 0
		},
		check: 0,
		x: 1
	},
	methods: {
		test: function() {
			this.x = 10;
			var users = [];
			for (var i = 1; i <= this.x; i++) {
				users.push(new User('_' + i, 'x'));
			}
			var group = this.groups.filter((item) => item.id == this.groupID)[0];
			var data = {
				users: JSON.stringify(users),
				group
			};
			var timeStart = (new Date).getTime();
			console.log('start');
			$.post('/apps/ranking-member', data, function(res) {
				console.log(res);
			});
		},
		start: function() {
			if (this.running) {
				return;
			}
			this.timeStart = (new Date()).getTime();
			this.timeEnd = (new Date()).getTime();
			this.running = true;
			$('#list-members').addClass('disabled');
			this.reset();
			this.icon.members = icon.loading;
			this.getTotalMenbers();
			this.getMembers();
		},
		reset: function() {
			let since = Math.ceil(new Date().getTime() / 1000) - this.interval * 24 * 3600;
			this.query = {
				totalMenbers: 'members.limit(0).summary(true)',
				members: 'members.limit(500){id,name}',
				posts: `feed.since(${since}).limit(50){id,from,created_time,comments.limit(0).summary(true),reactions.limit(0).summary(true)}`,
				commentsInPost: `comments.limit(5000).since(${since}){comments.limit(0).summary(true),reactions.limit(0).summary(true),from{id},created_time}`,
				commentsInComment: `comments.limit(5000).since(${since}){comments.limit(0).summary(true),reactions.limit(0).summary(true),from{id},created_time}`,
				reactionInPost: `reactions.limit(5000).since(${since}){id,created_time,type}`
			};
			this.icon = {
				members: '',
				post: '',
				postHasScanComments: '',
				postHasScanReaction: '',
				comments: '',
				reactions: ''
			};
			this.users = [];
			this.count = {
				posts: 0,
				comments: 0,
				reactions: 0
			};
			users.reset();
		},
		getGroups: function() {
			fb.graph('me', 'groups.limit(2000){name,icon}',
				groups => this.groups = groups, () => {}, 'v2.3');
		},
		getTotalMenbers: function() {
			this.members.total = fb.graphA(
				this.groupID,
				this.query.totalMenbers,
				'v2.6'
			).members.summary.total_count;
		},
		getMembers: function() {
			fb.graph(this.groupID, this.query.members, (members) => {
				members.forEach((member) => users.add(member));
			}, () => {
				this.icon.members = icon.endload;
				this.icon.post = icon.loading;
				this.icon.postHasScanComments = icon.loading;
				this.icon.postHasScanReaction = icon.loading;
				this.icon.comments = icon.loading;
				this.icon.reactions = icon.loading;
				this.getPosts();
			}, 'v2.3');
		},
		/* check */
		getPosts: function() {
			this.check++;
			fb.graph(this.groupID, this.query.posts, (posts) => {
				if (!posts.length) {
					return;
				}
				posts.forEach((post) => {
					if (!post.from) { return; }
					let ownPost = post.from.id;
					if (new Date(post.created_time).getTime() >= this.since) {
						users.post(ownPost);
					}

					if (post.comments.summary.total_count) {
						this.getReactionsInPost(post.id, ownPost);
					}

					if (post.reactions.summary.total_count) {
						this.getCommentsInPost(post.id, ownPost);
					}
				});
			}, () => {
				this.check--;
				this.icon.post = icon.endload;
				this.checkEnd();
			}, 'v2.6');
		},
		getReactionsInPost: function(postID, ownPost) {
			this.check++;
			fb.graph(postID, this.query.reactionInPost, (reactions) => {
				reactions.length && reactions.forEach((reaction) => {
					/*nếu reaction đã cũ thì bỏ qua*/
					if (new Date(reaction.created_time).getTime() < this.since) { return; }
					/*cộng điểm cho thằng Reac và thằng đăng bài*/
					users.reaction(reaction.id, ownPost, reaction.type);
				});
			}, () => {
				this.check--;
				this.checkEnd();
			}, 'v2.6');
			this.checkEnd();
		},
		getCommentsInPost: function(postID, ownPost) {
			this.check++;
			fb.graph(postID, this.query.commentsInPost, (comments) => {
				comments.forEach((comment) => {
					/* chỉ cộng điểm cho cmt mới*/
					if (new Date(comment.created_time).getTime() < this.since) {
						return;
					}
					/* cộng điểm cho thằng cmt và thằng đăng bài*/
					users.comment(comment.from.id, ownPost);
					/* lấy danh sách member reac cmt này*/
					if (comment.reactions.summary.total_count) {
						this.getReactionsInComment(comment.id, ownPost);
					}
					/* lấy danh sách member rep cmt này*/
					if (comment.comments.summary.total_count) {
						this.getCommentsInComment(comment.id, ownPost, comment.from.id);
					}
				});
			}, () => {
				this.check--;
				this.checkEnd();
			}, 'v2.6');
			this.checkEnd();
		},
		getReactionsInComment: function(commentID, ownCmt) {
			this.check++;
			fb.graph(commentID, this.query.reactionInPost, (reactions) => {
				reactions.forEach((reaction) => {
					/* không xét những reaction đã cũ */
					if (new Date(reaction.created_time).getTime() < this.since) {
						return;
					}
					/* cộng điểm cho thằng reac và thằng cmt*/
					users.reaction(reaction.id, ownCmt);
				});
			}, () => {
				this.check--;
				this.checkEnd();
			}, 'v2.6');
		},
		getCommentsInComment: function(commentID, ownPost, ownCmt) {
			this.check++;
			fb.graph(commentID, this.query.commentsInComment, (comments) => {
				comments.forEach((comment) => {
					/* không xét những cmt đã cũ */
					if (new Date(comment.created_time).getTime() < this.since) {
						return;
					}
					if (comment.reactions.summary.total_count) {
						this.getReactionsInComment(comment.id, ownCmt);
					}
					/* cộng điểm cho thằng cmt và thằng rep */
					users.comment(ownCmt, comment.from.id);
					/* cộng điểm cho thằng đăng bài*/
					/*if (this.members.list.has(ownPost) && ownRep !== ownPost) {
						this.members.list(ownPost).commentIn();
					}*/
				});
			}, () => {
				this.check--;
				this.checkEnd();
			}, 'v2.6');
			this.checkEnd();
		},
		checkEnd: function() {
			if (this.check != 0) {
				return;
			}
			this.endAll();
		},
		endAll: function() {
			this.running = false;
			this.icon.comments = icon.endload;
			this.icon.reactions = icon.endload;
			this.timeEnd = (new Date()).getTime();

			$('#list-members').removeClass("disabled");
			this.saving = true;
			for (var user of users.users.values()) {
				user.calculateScore(this.score);
				this.users.push(user);
			}
			/* save */
			var group = this.groups.filter((item) => item.id === this.groupID)[0];
			group = JSON.stringify(group);
			var memberActive = 0;
			this.users.forEach(function(user) {
				memberActive += (user.score > 0) * 1;
			});
			let data = {
				group,
				users: JSON.stringify(this.users),
				posts: this.count.posts,
				comments: this.count.comments,
				reactions: this.count.reactions,
				memberActive,
				memberCount: this.users.length
			};
			$.post('/apps/ranking-member', data, function(res) {
				console.log(res);
			}).fail(function(res) {
				console.log(res.responseText);
			}).always(() => {
				this.saving = false;
			});
			this.users.sort(function(a, b) {
				return b.score - a.score;
			});
		}
	},
	created: function() {

	},
	computed: {
		topUsers: function() {
			return this.users.slice(0, 30);
		}
	}
});
$(() => {
	fb = new FB('../../');
	$.get('/apps/token', function(token) {
		fb.setToken(token);
		fb.checkLiveToken();
		app.reset();
		app.getGroups();
	});
});