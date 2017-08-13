'use strict';
var since = '-7 days';
var fb;
var icon = {
	loading: 'fa fa-spinner fa-spin',
	endload: 'fa fa-check-circle text-success'
};
function zz() {
	this.mustCheck = 0;
	this.hasCheck = 0;
	this.end = false;
}
var rank = {
	challenger : 'images/ChallengerBadge.png',
	master     : 'images/MasterBadge.png',
	diamond    : 'images/DiamondBadge.png',
	platimun   : 'images/PlatinumBadgeSeason.png',
	gold       : 'images/GoldBadgeSeason.png',
	silver     : 'images/SilverBadgeSeason.png',
	bronze     : 'images/BronzeBadgeSeason.png',
	unknown    : 'images/UnrankedBadge.png',
	arr: [
		'images/ChallengerBadge.png',
		'images/MasterBadge.png',
	 	'images/DiamondBadge.png',
		'images/PlatinumBadgeSeason.png',
		'images/GoldBadgeSeason.png',
		'images/SilverBadgeSeason.png',
		'images/BronzeBadgeSeason.png',
		'images/UnrankedBadge.png',
	],
	total: 8
};
var listGroups = new Vue({
	el: '#list-groups',
	data: {
		groups: []
	},
	methods: {
		getListGroups: function() {
			fb.graph('me', 'groups.limit(100){name,icon}', function(res) {
				listGroups.groups = res;
			}, Null, 'v2.3');
		}
	}
});
function User(id, name) {
	this.rank = rank.unknown;
	this.id = id;
	this.name = name;
	this.post = 0;
	this.comments = { in: 0, out: 0 };
	this.reactions = { in: 0, out: 0 };
	this.score = '?';
	this.getData = function() {
		let rank      = this.rank;
		let id        = this.id;
		let name      = this.name;
		let post      = this.post;
		let comments  = this.comments;
		let reactions = this.reactions;
		let score     = this.score;
		let data = {rank, id, name, post, comments, reactions, score};
		return data;
	};
	this.commentIn = function() {
		this.comments.in++;
	};
	this.commentOut = function() {
		statistics.comments.total++;
		this.comments.out++;
	};
	this.reactionIn = function() {
		this.reactions.in++;
	};
	this.reactionOut = function() {
		statistics.reactions.total++;
		this.reactions.out++;
	};
	this.postOut = function() {
		this.post++;
	};
	this.calculateScore = function() {
		this.score = (this.reactions.in + this.reactions.out) * 1
		 + (this.comments.in + this.comments.out) * 3
		 + this.post * 5;
		return this;
	};
	return this;
}
function Null() {}
var statistics = new Vue({
	el: '#statistics',
	data: {
		idGroup: '',
		post: { total: '?', hasScanComments: '?', hasScanReaction: '?'},
		comments: { total: '?', mustCheckRep: 0, hasCheckRep: 0},
		reactions: { total: '?' },
		members: { total: '?', real: '?', list: [], key: {} },
		end: {comments: false, reactions: false, post: false},
		query: {
			totalMenbers: 'members.limit(0).summary(true)',
			listMembers: 'members.limit(500)',
			listPosts: `feed.since(${since}).limit(200){id,from}`,
			listCommentsInPost: `comments.limit(1000).since(${since}){comments.limit(0).summary(true),from{id}}`,
			listCommentsInComment: '',
			listReactionInPost: `reactions.limit(1000).since(${since}){id}`
		},
		icon: {
			members: '',
			postHasScanComments: '',
			postHasScanReaction: '',
			post: '',
			comments: '',
			reactions: ''
		}
	},
	methods: {
		resetData: function() {
			this.post      = { total: 0, hasScanComments: 0, hasScanReaction: 0};
			this.comments  = { total: 0, mustCheckRep: 0, hasCheckRep: 0};
			this.reactions = { total: 0 };
			this.members   = { total: 0, real: 0, list: [], key: {}};
			this.end       = {comments: false, reactions: false, post: false};
		},
		getTotalMenbers: function() {
			var idGroup = this.idGroup,
				query = this.query.totalMenbers;
			this.members.total = fb.graphA(idGroup, query, 'v2.6').members.summary.total_count;
			return this.members.total;
		},
		addMember: function(idMember, nameMember) {
			if (typeof statistics.members.key[`_${idMember}`] === 'undefined') {
				statistics.members.key[`_${idMember}`] = statistics.members.real++;
				statistics.members.list.push(new User(idMember, nameMember));
			}
			return statistics.members.key[`_${idMember}`];
		},
		getListMembers: function() {
			statistics.icon.members = icon.loading;
			fb.graph(this.idGroup, this.query.listMembers, function(res) {
				res.forEach(function(member) {
					statistics.addMember(member.id, member.name);
				});
			}, statistics.endGetListMembers, 'v2.3');
		},
		endGetListMembers: function() {
			statistics.icon.members = icon.endload;
			statistics.getListPost();
		},
		getListPost: function() {
			statistics.icon.postHasScanComments = icon.loading;
			statistics.icon.postHasScanReaction = icon.loading;
			statistics.icon.post                = icon.loading;
			statistics.icon.comments            = icon.loading;
			statistics.icon.reactions           = icon.loading;
			// let check = zz();
			fb.graph(statistics.idGroup, statistics.query.listPosts, function(res) {
				if (!res) {
					return;
				}
				statistics.post.total += res.length;
				res.forEach(function(post) {
					let ownPost = statistics.addMember(post.from.id, post.from.id);
					/*cộng điểm cho thằng đăng bài*/
					statistics.members.list[ownPost].postOut();
					/*quét bình luận*/
					fb.graph(post.id, statistics.query.listCommentsInPost, function(res) {
						statistics.getListCommentsInPost(res, ownPost)
					}, statistics.endGetListCommentsInPost, 'v2.3');
					/*quết reaction*/
					fb.graph(post.id, statistics.query.listReactionInPost, function(res) {
						statistics.getListReactionInPost(res, ownPost);
					}, statistics.endGetListReactionInPost, 'v2.6');
				});
			}, statistics.endGetListPost, 'v2.3');
		},
		getListReactionInPost: function(res, ownPost) {
			res.forEach(function(reaction) {
				if (statistics.members.key[`_${reaction.id}`]) {
					let ownReac = statistics.addMember(reaction.id, reaction.name);
					/* cộng điểm cho thằng like */
					statistics.members.list[ownReac].reactionOut();
					/* cộng điểm cho thằng đăng bài*/
					if(ownReac !== ownPost){
						statistics.members.list[ownPost].reactionIn();
					}
				}
			});
		},
		getListCommentsInPost: function(res, ownPost) {
			if (!res.length) {
				return;
			}
			statistics.comments.mustCheckRep += res.length;
			res.forEach(function(comment) {
				let ownCmt = statistics.addMember(comment.from.id, comment.from.id);
				// cộng điểm đã bình luận cho thằng bình luận
				statistics.members.list[ownCmt].commentOut();
				// cộng điểm được bình luận cho thằng đăng bài
				if(ownCmt !== ownPost){
					statistics.members.list[ownPost].commentIn();
				}
				//lấy danh sách những người là trả lời bình luận của họ
				if (comment.comments.summary.total_count) {
					fb.graph(comment.id, 'comments.limit(1000){from{id}}', function(res) {
						statistics.getCommentsInComment(res, ownPost, ownCmt);
					}, statistics.endGetCommentsInComment, 'v2.3');
				} else {
					statistics.comments.hasCheckRep ++;
					statistics.checkEnd();
				}
			});
		},
		getCommentsInComment: function(res, ownPost, ownCmt) {
			res.forEach(function(comment) {
				let ownRep = statistics.addMember(comment.from.id);
				// cộng điểm cho thằng trả lời bình luận
				statistics.members.list[ownRep].commentOut();
				// cộng điểm cho thằng được trả lời bình luận
				if(ownRep != ownCmt){
					statistics.members.list[ownCmt].commentIn();
				}
				/* cộng điểm cho thằng đăng bài*/
				if(ownRep != ownPost){
					statistics.members.list[ownPost].commentIn();
				}
			});
		},/* end */
		endGetListPost: function() {
			statistics.end.post  = true;
			statistics.icon.post = icon.endload;
			statistics.checkEnd();
		},
		endGetListReactionInPost: function() {
			statistics.post.hasScanReaction++;
			statistics.checkEnd();
		},
		endGetListCommentsInPost: function() {
			statistics.post.hasScanComments++;
			statistics.checkEnd();
		},
		endGetCommentsInComment: function() {
			statistics.comments.hasCheckRep++;
			statistics.checkEnd();
		},/* đã test cứng k cần sửa nhiều*/
		saveJSON: function() {
			let members = [];
			statistics.members.list.forEach(function(member, index) {
				members.push(member.getData());
			})
			let data = {
				g: statistics.idGroup,
				d: {members}
			};
			$.post('save-json.php', data, function(res) {
				console.log(res);
			});
		},
		checkEnd: function() {
			if(!statistics.end.post){
				return;
			}
			if(statistics.post.total === statistics.post.hasScanReaction){
				statistics.icon.postHasScanReaction = icon.endload;
				statistics.end.reactions = true;
			}
			if(statistics.post.total === statistics.post.hasScanComments){
				statistics.end.comments = true;
			}
			// console.log(`
			// 	${statistics.comments.mustCheckRep} - ${statistics.comments.hasCheckRep} | ${statistics.end.post} | ${statistics.post.total}- ${statistics.post.hasScanReaction} - ${statistics.post.hasScanComments} |
			// `);
			if(statistics.end.reactions && statistics.end.comments &&
				statistics.comments.mustCheckRep === statistics.comments.hasCheckRep){
				statistics.icon.postHasScanComments = icon.endload;
				statistics.icon.comments  = icon.endload;
				statistics.icon.reactions = icon.endload;
				statistics.endAll();
				statistics.saveJSON();
			}
		},
		endAll: function() {
			let length = statistics.members.list.length;
			for (var i = 0; i < length; i++) {
				statistics.members.list[i].calculateScore();
			}
			statistics.members.list.sort(function(a, b) {
				return b.score - a.score;
			});
			let currentRank = -1, scoreMax = statistics.members.list[0] + 1;
			for (var i = 0; i < length; i++) {
				if(currentRank < (rank.total - 2)){
					currentRank++;
					// scoreMax = statistics.members.list[i].score;
				}
				if(statistics.members.list[i].score){
					statistics.members.list[i].rank = rank.arr[currentRank];
				}	
			}
		}
	}
});
var page = new Vue({
	el: '#list-member-or-friend',
	data: {
		listRecords: [],
		totalRecord: 0,
		recordPerPage: 10,

		currentPage: 1,
		totalPage: 0
	},
	methods: {
		next: function() {
			if (this.currentPage < this.totalPage) {
				this.currentPage++;
			}
		},
		prew: function() {
			if (1 < this.currentPage) {
				this.currentPage--;
			}
		},
		first: function() {
			this.currentPage = 1;
		},
		last: function() {
			this.currentPage = this.totalPage;
		},
		setRecord: function(records) {
			this.listRecords = records;
		}
	}
});
var ok = 0;
/* danh sách action*/
function start() {
	statistics.resetData();
	ok = 0;
	statistics.idGroup = $("#list-groups option:selected").attr('data-id-group');
	statistics.getTotalMenbers();
	statistics.getListMembers();
}



$(function action() {
	$("#start").click(start);
});
$(function construct() { /* khởi tạo các giá trị ban đầu*/
	fb = new FB('../../');
	fb.setToken($.cookie('token'));
	fb.checkLiveToken();
	listGroups.getListGroups();
});