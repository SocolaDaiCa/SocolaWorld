'use strict';
var since = '-7 days';
var fb;
var icon = {
    loading: 'fa fa-spinner fa-spin',
    endload: 'fa fa-check-circle text-success'
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
    this.id = id;
    this.name = name;
    this.post = 0;
    this.comments = { in: 0, out: 0 };
    this.reactions = { in: 0, out: 0 };
    this.score = '?';
    this.commentIn = function() {
        this.comments.in++;
    };
    this.commentOut = function() {
        statistics.comments.hasScan++;
        this.comments.out++;
    };
    this.reactionIn = function() {
        this.reactions.in++;
    };
    this.reactionOut = function() {
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
        post: { total: '?', hasScanComments: '?', hasScanReaction: '?', end: false },
        comments: { total: '?', hasScan: 0, end: false },
        reactions: { total: '?' },
        members: { total: '?', real: '?', list: [], key: {} },
        end: {comments: false, reactions: false, post: false},
        query: {
            totalMenbers: 'members.limit(0).summary(true)',
            listMembers: 'members.limit(500)',
            listPosts: `feed.since(${since}).limit(200){id,from}`,
            listCommentsInPost: `comments.limit(1000).since(${since}){comments.limit(0).summary(true),from{id}}`,
            listCommentsInComment: ''
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
            this.post = { total: 0, hasScanComments: 0, hasScanReaction: 0, end: false };
            this.comments = { total: 0, hasScan: 0, end: false };
            this.reactions = { total: 0 };
            this.members = { total: 0, real: 0, list: [], key: {} };
        },
        getTotalMenbers: function() {
            var idGroup = this.idGroup,
                query = this.query.totalMenbers;
            this.members.total = fb.graphA(idGroup, query, 'v2.6').members.summary.total_count;
            return this.members.total;
        },
        getListMembers: function() {
            statistics.icon.members = icon.loading;
            var idGroup = this.idGroup,
                query = this.query.listMembers;
            fb.graph(idGroup, query, function(res) {
                // dếm số bạn hoặc thành viên thực tế tìm đc
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
            statistics.icon.post = icon.loading;
            // statistics.icon.comments = icon.loading;
            // statistics.icon.reactions = icon.loading;
            var idGroup = statistics.idGroup,
                query = statistics.query.listPosts;
            fb.graph(idGroup, query, function(res) {
                if (!res) {
                    return;
                }
                statistics.post.total += res.length;
                res.forEach(function(post) {
                    // cộng điểm cho thằng đăng bài
                    let ownPost = statistics.addMember(post.from.id, post.from.id);
                    statistics.members.list[ownPost].postOut();
                    /*quét bình luận*/
                    fb.graph(post.id, statistics.query.listCommentsInPost,
                        function(res) {
                            statistics.getListCommentsInPost(res, ownPost)
                        },
                        statistics.endGetListCommentsInPost, 'v2.3');
                    /*quết reaction*/
                    fb.graph(post.id, `reactions.limit(1000).since(${since}){id}`,
                        statistics.getListReactionInPost,
                        statistics.endGetListReactionInPost, 'v2.6');
                });
            }, statistics.endGetListPost, 'v2.3');
        },
        endGetListPost: function() {
            statistics.end.post = true;
            statistics.icon.post = icon.endload;
            statistics.checkEnd();
        },
        getListCommentsInPost: function(res, ownPost) {
            if (!res) {
                return;
            }
            statistics.comments.total += res.length;
            res.forEach(function(comment) {
                let ownCmt = statistics.addMember(comment.from.id, comment.from.id);
                // cộng điểm bình luận cho thằng bình luận
                statistics.members.list[ownCmt].commentOut();
                // cộng điểm bình luận cho thằng đăng bài
                if(ownCmt !== ownPost){
                    statistics.members.list[ownPost].commentIn();
                }
                //lấy danh sách những người là trả lời bình luận của họ
                if (comment.comments.summary.total_count) {
                    fb.graph(comment.id, 'comments.limit(1000){from{id}}',
                        function(res) {
                            statistics.getCommentsInComment(res, ownPost, ownCmt);
                        }, statistics.endGetCommentsInComment, 'v2.3');
                }
            });
        },
        getCommentsInComment: function(res, ownPost, ownCmt) {
            statistics.comments.total += res.length;
            res.forEach(function(comment) {
                var ownRep = statistics.addMember(comment.from.id);
                // cộng điểm cho thằng trả lời bình luận
                statistics.members.list[ownRep].commentOut();
                // cộng điểm cho được trả lời bình luận
                if(ownRep != ownPost){
                    statistics.members.list[ownPost].commentIn();
                }
                if(ownRep != ownCmt){
                    statistics.members.list[ownCmt].commentIn();
                }
            });
            
        },
        endGetCommentsInComment: function() {
            
        },
        endGetListCommentsInPost: function() {
            statistics.post.hasScanComments++;
            statistics.checkEnd();
        },
        getListReactionInPost: function(res) {
            statistics.reactions.total += res.length;
            res.forEach(function(reaction) {
                if (statistics.members.key[`_${reaction.id}`]) {
                    // cộng điểm cho thằng like
                    let index = statistics.addMember(reaction.id, reaction.name);
                    statistics.members.list[index].reactionOut();
                }
            });
        },
        endGetListReactionInPost: function() {
            statistics.post.hasScanReaction++;
            statistics.checkEnd();
        },
        addMember: function(idMember, nameMember) {
            if (typeof statistics.members.key[`_${idMember}`] === 'undefined') {
                statistics.members.key[`_${idMember}`] = statistics.members.real++;
                statistics.members.list.push(new User(idMember, nameMember));
            }
            return statistics.members.key[`_${idMember}`];
        },
        checkEnd: function() {
            /* scan reaction end */
            if(statistics.end.post && statistics.post.hasScanReaction === statistics.post.total){
                statistics.end.reactions = true;
                statistics.icon.reactions = icon.endload;
            }
            // /* scan comment end */
            if(statistics.end.post && statistics.post.hasScanComments === statistics.post.total){
                statistics.end.comments = true;
                statistics.icon.comments = icon.endload;
            }
            // /*nếu tất cả đều đã kết thức thì tính điểm cho từng thằng*/
            // if (statistics.end.comments && statistics.end.reactions){
            //     statistics.endAll();
            // }
        },
        endAll: function() {
            let length = statistics.members.list.length;
            for (var i = 0; i < length; i++) {
                statistics.members.list[i].calculateScore();
            }
            statistics.members.list.sort(function(a, b) {
                return b.score - a.score;
            })
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
    Promise.all([statistics.getListMembers]).then(values => { 
      // console.log(values); // [3, 1337, "foo"] 
        console.log('enddddddd');
      statistics.endAll();
    });
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