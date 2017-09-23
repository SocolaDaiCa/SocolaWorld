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
            fb.checkLiveToken();
            /* bắt đầu lọc bình luận*/
            fb.graph(this.idStatus, 'comments', function showComment(listComments) {
                if (!listComments) { return; }
                listComments.forEach(function(comment) {
                    app.addComment(comment);
                    app.addIfHasMail(comment);
                    app.addIfhasPhone(comment);
                    app.addIfhasLink(comment);
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
    var re = new RegExp('^(https?|ftp|file)(:\\/\\/)?'+ // protocol
  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return re.test(url);
}
$(function() {
    fb = new FB('../../');
    fb.setToken($.cookie('token'));
    fb.checkLiveToken();
});