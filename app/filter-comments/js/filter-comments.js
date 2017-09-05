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
        commentsHasPhone: []
    },
    methods: {
        filterComments: function() {
            if (app.process) { return; }
            app.process = true;
            /* xóa dữ liệu trong bảng từ lần lọc bình luận trước*/
            app.cleardata();
            /* kiểm tra token trước khi lọc bình luận*/
            fb.checkLiveToken();
            /* bắt đầu lọc bình luận*/
            fb.graph(this.idStatus, 'comments', function showComment(listComments) {
                if (!listComments) { return; }
                listComments.forEach(function(comment) {
                    app.addComment(comment);
                    app.addIfHasMail(comment);
                    app.addIfhasPhone(comment);
                });
            }, function() {
                app.process = false;
            }, 'v2.10');
        },
        addComment: function(comment) {
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
        addCommentHaddIfhasPhoneasPhone: function(comment) {
            var words = app.getWords(comment);
            words.forEach(function(word) {
                if (validatePhone(word)) { // nếu chứa mail thì
                    comment.phone = word;
                    return app.commentsHasPhone.push(comment);
                }
            });
        }
    },
    getWords: function(comment) {
        return comment.message.split(/,| |\n/);
    },
    cleardata: function() {
        this.allComments = [];
        this.commentsHasMail = [];
        this.commentsHasPhone = [];
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

$(function() {
    fb = new FB('../../');
    fb.setToken($.cookie('token'));
    fb.checkLiveToken();
});