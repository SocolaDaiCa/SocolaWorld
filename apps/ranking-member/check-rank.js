'use strict';
var fb;
var icon = {
    loading: 'fa fa-spinner fa-spin',
    endload: 'fa fa-check-circle text-success'
};
var postDontCare = [
    '677222392439615_802643839897469'
];
var rank = {
    score: [],
    setScore: function(minScore) {
        let jumb = 10;
        this.score = [];
        this.score.unshift(0); /* unrank*/
        this.score.unshift(minScore); /* đồng 5*/
        /*đồng 4 3 2 1*/
        for (let i = 4; i >= 1; i--) {
            jumb += 1;
            minScore += jumb;
            rank.score.unshift(minScore);
        }
        for (let i = 1; i <= 4; i++) {
            for (let j = 1; j <= 5; j++) {
                jumb += i;
                minScore += jumb;
                rank.score.unshift(minScore);
            }
        }
        /* cao thủ thách đấu + = 5*/
        jumb += 5;
        minScore += jumb;
        rank.score.unshift(minScore);
        jumb += 5;
        minScore += jumb;
        rank.score.unshift(minScore);
    }
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
// class User{

// };
function User(id, name) {
    this.rank = 27;
    this.id = id;
    this.name = name;
    this.posts = 0;
    this.comments = { in: 0, out: 0 };
    this.reactions = { in: 0, out: 0 };
    this.detailReactions = { LIKE: 0, LOVE: 0, HAHA: 0, WOW: 0, SAD: 0, ANGRY: 0 };
    this.score = '?';
    /* get thôi khỏi set*/
    return this;
}
User.prototype.getData = function() {
    let rank = this.rank;
    let id = this.id;
    let name = this.name;
    let posts = this.posts;
    let comments = this.comments;
    let reactions = this.reactions;
    let score = this.score;
    return { rank, id, name, posts, comments, reactions, score };
};
User.prototype.commentIn = function() {
    this.comments.in++;
};
User.prototype.commentOut = function() {
    statistics.comments.total++;
    this.comments.out++;
};
User.prototype.reactionIn = function(type) {
    this.reactions.in++;
    this.detailReactions[type]++;
};
User.prototype.reactionOut = function(type) {
    statistics.reactions.total++;
    this.reactions.out++;
    this.detailReactions[type]++;
};
User.prototype.postOut = function() {
    this.posts++;
};
User.prototype.calculateScore = function() {
    let score = statistics.score;
    this.score = this.posts * score.post +
        (this.comments.in + this.comments.out) * score.comment +
        this.detailReactions.LIKE * score.like +
        this.detailReactions.LOVE * score.love +
        this.detailReactions.HAHA * score.haha +
        this.detailReactions.WOW * score.wow +
        this.detailReactions.SAD * score.sad +
        this.detailReactions.ANGRY * score.angry;
    // this.score = (this.reactions.in + this.reactions.out) * 1 +
    // (this.comments.in + this.comments.out) * 3 +
    // this.posts * 5;
    return this;
};
User.prototype.getPost = function() {
    return this.post;
};
User.prototype.getCommentOut = function() {
    return this.comments.out;
};
User.prototype.getCommentsIn = function() {
    return this.comments.in;
};
User.prototype.getReactionsOut = function() {
    return this.reactions.out;
};
User.prototype.getReactionsIn = function() {
    return this.reactions.in;
};
/*end user*/
function Null() {}
var statistics = new Vue({
    el: '#statistics',
    data: {
        top: 300,
        starting: 0,
        interval: '',
        since: 0,
        intervalView: '',
        idGroup: '',
        post: { total: '?', hasScanComments: '?', hasScanReaction: '?' },
        comments: { total: '?', mustCheckRep: 0, hasCheckRep: 0, hasCheckReac: 0 },
        reactions: { total: '?' },
        members: { total: '?', real: '?', list: [], key: {}, active: '?' },
        end: { comments: false, reactions: false, post: false, all: false },
        query: {},
        icon: {
            members: '',
            postHasScanComments: '',
            postHasScanReaction: '',
            post: '',
            comments: '',
            reactions: ''
        },
        listPostsDontCare: [],
        score: { post: 5, comment: 3, like: 1, love: 1, haha: 1, wow: 1, sad: 1, angry: 1 },
        sort: { post: -1, commnetOut: -1, commentIn: -1, reactionOut: -1, reactionIn: -1, score: 1 }
    },
    computed: {
        topMembers: function() {
            return this.members.list.slice(0, this.top);
        }
    },

    methods: {
        resetData: function() {
            this.post = { total: 0, hasScanComments: 0, hasScanReaction: 0 };
            this.comments = { total: 0, mustCheckRep: 0, hasCheckRep: 0, hasCheckReac: 0 };
            this.reactions = { total: 0 };
            this.members = { total: 0, real: 0, list: [], key: {}, active: '?' };
            this.end = { comments: false, reactions: false, post: false, all: false };
            this.sort = { post: -1, commentOut: -1, commentIn: -1, reactionOut: -1, reactionIn: -1, score: 1 };
            // let since = this.interval === 1 ? `-1 day` : `-${this.interval} days`;
            let since = Math.ceil(new Date().getTime() / 1000) - this.interval * 24 * 3600;
            this.intervalView = `trong ${this.interval} ngày gần đây`;
            this.query = {
                totalMenbers: 'members.limit(0).summary(true)',
                listMembers: 'members.limit(500){id,name}',
                listPosts: `feed.since(${since}).limit(3){id,from,created_time}`,
                listCommentsInPost: `comments.limit(200).since(${since}){comments.limit(0).summary(true),from{id},created_time}`,
                listCommentsInComment: `comments.limit(200).since(${since}){comments.limit(0).summary(true),from{id},created_time}`,
                listReactionInPost: `reactions.limit(1000).since(${since}){id,created_time,type}`
            };
            this.since = since * 1000;
        },
        start: function() {
            if (this.starting) { return; }
            this.starting = true;
            $('#list-members').addClass('disabled');
            statistics.resetData();
            statistics.idGroup = $("#list-groups option:selected").attr('data-id-group');
            statistics.getTotalMenbers();
            statistics.getListMembers();
            // statistics.getListPost();
        },
        getTotalMenbers: function() {
            this.members.total = fb.graphA(this.idGroup, this.query.totalMenbers, 'v2.6').members.summary.total_count;
        },
        addMember: function(memberId, memberName) {
            if (typeof statistics.members.key[`_${memberId}`] === 'undefined') {
                statistics.members.key[`_${memberId}`] = statistics.members.real++;
                statistics.members.list.push(new User(memberId, memberName));
            }
            return statistics.members.key[`_${memberId}`];
        },
        getListMembers: function() {
            statistics.icon.members = icon.loading;
            fb.graph(this.idGroup, this.query.listMembers, function(listMembers) {
                for (let i = listMembers.length - 1; i >= 0; i--) {
                    statistics.addMember(listMembers[i].id, listMembers[i].name);
                }
            }, function end() {
                statistics.icon.members = icon.endload;
                statistics.getListPost();
            }, 'v2.3');
        },
        getListPost: function() {
            statistics.icon.postHasScanComments = icon.loading;
            statistics.icon.postHasScanReaction = icon.loading;
            statistics.icon.post = icon.loading;
            statistics.icon.comments = icon.loading;
            statistics.icon.reactions = icon.loading;
            fb.graph(statistics.idGroup, statistics.query.listPosts, function(listPosts) {
                if(!listPosts.length) {return;}
                listPosts.forEach(function(post) {
                    statistics.post.total++;
                    let ownPost = statistics.addMember(post.from.id, post.from.id);
                    if (new Date(post.created_time).getTime() >= statistics.since) {
                        statistics.members.list[ownPost].postOut();
                    }
                    statistics.getListReactionsInPost(post.id, ownPost);
                    statistics.getListCommentsInPost(post.id, ownPost);
                });
            }, function endGetListPost() {
                statistics.end.post = true;
                statistics.icon.post = icon.endload;
                statistics.checkEnd();
            }, 'v2.3');
        },
        getListReactionsInPost: function(postId, ownPost) {
            fb.graph(postId, statistics.query.listReactionInPost, function(listReactions) {
                listReactions.forEach(function(reaction) {
                    /*nếu reaction đã cũ thì bỏ qua*/
                    if (new Date(reaction.created_time).getTime() < statistics.since) { return; }
                    let ownReac = -1;
                    if (statistics.members.key[`_${reaction.id}`]) { /*cộng điểm cho thằng like*/
                        ownReac = statistics.addMember(reaction.id, reaction.name);
                        statistics.members.list[ownReac].reactionOut(reaction.type);
                    }
                    if (ownReac !== ownPost) { /*cộng điểm cho thằng đăng bài*/
                        statistics.members.list[ownPost].reactionIn(reaction.type);
                    }
                });
            }, function endGetListReactionInPost() {
                statistics.post.hasScanReaction++;
                statistics.checkEnd();
            }, 'v2.6');
            statistics.checkEnd();
        },
        getListCommentsInPost: function(postId, ownPost) {
            fb.graph(postId, statistics.query.listCommentsInPost, function(listComments) {
                if(!listComments.length){ return;}
                listComments.forEach(function(comment) {
                    statistics.comments.mustCheckRep++;
                    let ownCmt = statistics.addMember(comment.from.id, comment.from.id);
                    /* chỉ cộng điểm cho cmt mới*/
                    if (new Date(comment.created_time).getTime() >= statistics.since) {
                        statistics.members.list[ownCmt].commentOut();
                        if (ownCmt !== ownPost) {
                            statistics.members.list[ownPost].commentIn();
                        }
                    }
                    //lấy danh sách những người là trả lời bình luận của họ
                    if (comment.comments.summary.total_count) {
                        statistics.getCommentsInComment(comment.id, ownPost, ownCmt);
                    } else {
                        statistics.comments.hasCheckRep++;
                    }
                    statistics.getListReactionsInComment(comment.id, ownCmt);
                });
            }, function endGetListCommentsInPost() {
                statistics.post.hasScanComments++;
                statistics.checkEnd();
            }, 'v2.3');
            statistics.checkEnd();
        },
        /*xong đoạn này*/
        getCommentsInComment: function(commentId, ownPost, ownCmt) {
            fb.graph(commentId, statistics.query.listCommentsInComment, function(listComments) {
                listComments.forEach(function(comment) {
                    statistics.getListReactionsInComment(comment.id, ownCmt);
                    if (new Date(comment.created_time).getTime() < statistics.since) { return; }
                    let ownRep = statistics.addMember(comment.from.id);
                    // cộng điểm cho thằng trả lời bình luận
                    statistics.members.list[ownRep].commentOut();
                    // cộng điểm cho thằng được trả lời bình luận
                    (ownRep !== ownCmt) && statistics.members.list[ownCmt].commentIn();
                    // /* cộng điểm cho thằng đăng bài*/
                    (ownRep !== ownPost) && statistics.members.list[ownPost].commentIn();
                });
            }, function endGetCommentsInComment() {
                statistics.comments.hasCheckRep++;
                statistics.checkEnd();
            }, 'v2.3');
            statistics.checkEnd();
        },
        getListReactionsInComment: function(commentId, ownCmt) {
            fb.graph(commentId, statistics.query.listReactionInPost, function(listReactions) {
                listReactions.forEach(function(reaction) {
                    if (new Date(reaction.created_time).getTime() < statistics.since) { return; }
                    // cộng điểm cho thằng reac
                    let ownReac = statistics.addMember(reaction.id, reaction.id);
                    statistics.members.list[ownReac].reactionOut(reaction.type);
                    /* cộng điểm cho thằng bình luận*/
                    statistics.members.list[ownCmt].reactionIn(reaction.type);
                });
            }, function end() {
                statistics.comments.hasCheckReac++;
                statistics.checkEnd();
            }, 'v2.6');
            statistics.checkEnd();
        },
        /* đã test cứng k cần sửa nhiều*/
        saveJSON: function() {
            let members = [];
            statistics.members.list.forEach(function(member) {
                members.push(member.getData());
            });
            let data = {
                g: statistics.idGroup,
                d: JSON.stringify({
                    total: {
                        posts: statistics.post.total,
                        reactions: statistics.reactions.total,
                        comments: statistics.comments.total,
                        activeMembers: statistics.members.active,
                        members: statistics.members.total
                    },
                    members: members
                })
            };
            $.post('save-json.php', data, function(res) {
                console.log(res);
            });
        },
        checkEnd: function() {
            // let endAll = true;
            if (!statistics.end.post) {
                return;
            }
            if (statistics.post.total === statistics.post.hasScanReaction) {
                statistics.end.reactions = true;
            }
            if (statistics.post.total === statistics.post.hasScanComments) {
                statistics.end.comments = true;

            }
            if (statistics.end.reactions && statistics.end.comments &&
                statistics.comments.mustCheckRep === statistics.comments.hasCheckRep &&
                statistics.comments.hasCheckReac === statistics.comments.total) {
                statistics.icon.postHasScanComments = icon.endload;
                statistics.icon.postHasScanReaction = icon.endload;
                statistics.icon.comments = icon.endload;
                statistics.icon.reactions = icon.endload;
                statistics.endAll();
                statistics.saveJSON();
            }
        },
        endAll: function() {
            statistics.end.all = true;
            let length = statistics.members.list.length;
            for (var i = 0; i < length; i++) {
                statistics.members.list[i].calculateScore();
            }
            /* sắp xếp rank */
            statistics.members.list.sort(function(a, b) {
                /* thứ tự ưu tiên score, post, comment*/
                if (b.score - a.score !== 0) {
                    return b.score - a.score;
                }
                if (b.posts - a.posts) {
                    return b.posts - a.posts;
                }
                if (b.comments - a.comments) {
                    return b.comments - a.comments;
                }
                return 0;
            });
            /* thêm biểu tượng rank tương ứng*/
            /* lấy điểm thằng nát nhất != 0*/
            let indexMinScore = statistics.members.list.length - 1;
            statistics.members.active = statistics.members.real;
            while (indexMinScore && !statistics.members.list[indexMinScore].score) {
                indexMinScore--;
                statistics.members.active--;
            }
            let minScore = statistics.members.list[indexMinScore].score;
            rank.setScore(minScore);
            let currentRank = 0;
            /* set rank cho từng thằng*/
            statistics.members.list.forEach(function(member, index) {
                while (member.score < rank.score[currentRank]) {
                    currentRank++;
                }
                statistics.members.list[index].rank = currentRank;
            });
            /* giáng cấp của thách đầu ngoài top 5 xuống cao thủ*/
            statistics.members.list.forEach(function(member, index) {
                if (member.rank !== 0) {
                    return;
                }
                if (index > 4) {
                    statistics.members.list[index].rank = 1;
                }
            });
            statistics.starting = false;
            $('#list-members').removeClass("disabled");
        },
        /* sort*/
        sortPost: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.post - a.post) /* * x*/ ;
            });
        },
        sortCommentOut: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.comments.out - a.comments.out) /* * x*/ ;
            });
        },
        sortCommentIn: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.comments.in - a.comments.in) /* * x*/ ;
            });
        },
        sortReactionOut: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.reactions.out - a.reactions.out) /* * x*/ ;
            });
        },
        sortReactionIn: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.reactions.in - a.reactions.in) /* * x*/ ;
            });
        },
        sortScore: function() {
            this.members.list.sort(function(a, b) { /* giản dần*/
                return (b.score - a.score) /* * x*/ ;
            });
        }
    }
});
$(function construct() { /* khởi tạo các giá trị ban đầu*/
    fb = new FB('../../');
    fb.setToken($.cookie('token'));
    fb.checkLiveToken();
    listGroups.getListGroups();
});
$(function() {
    $.getJSON('../API/get-list-post-dont-care.php', function(listPostsDontCare) {
        statistics.listPostsDontCare = listPostsDontCare;
    });
});