'use strict';
/* danh sách các biến*/
var fb;
var data = {
    allComments: [],
    commentsHasMail: [],
    commentsHasPhone: []
};
var methods = {
    addComment: function(comment) {
        this.allComments.push(comment);
    },
    addCommentHasMail: function(comment) {
        this.commentsHasMail.push(comment);
    },
    addCommentHasPhone: function(comment) {
        this.commentsHasPhone.push(comment);
    },
    clear: function() {
        this.allComments = [];
        this.commentsHasMail = [];
        this.commentsHasPhone = [];
    }
};
var listComments = new Vue({
    el: '#list-comments',
    data: data,
    methods: methods
});
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function validatePhone(phone) {
    var re = /^\+?([0-9]{2,})\)?[-. ]?([0-9]{2,})[-. ]?([0-9]{2,})$/;
    return re.test(phone);
}
function addIfHasMail(comment) {
    var words = comment.message.split(' ');
    words.forEach(function(word) {
        if (validateEmail(word)) { // nếu chứa mail thì
        	comment.mail = word;
            return listComments.addCommentHasMail(comment);
        }
    });
}
function addIfhasPhone(comment) {
    var words = comment.message.split(' ');
    words.forEach(function(word) {
        if (validatePhone(word)) { // nếu chứa mail thì
            comment.phone = word;
            return listComments.addCommentHasPhone(comment);
        }
    });
}
function showComment(comments) {
    if (!comments) { // k có comments thì k in ra
        return;
    } // nếu có thì
    comments.forEach(function(comment) {
    	/*tất cả bình luận*/
        listComments.addComment(comment);
        // chỉ bình luận chứa mail
        addIfHasMail(comment);
        // chỉ bình luận chứa số điện thoại
        addIfhasPhone(comment);
    });

}

function endShowComments() {

}

function filterComments() {
    var idStatus = $("#id-status").val();
    /* xóa dữ liệu trong bảng từ lần lọc bình luận trước*/

    listComments.clear();
    /* kiểm tra token trước khi lọc bình luận*/
    fb.checkLiveToken();
    /* bắt đầu lọc bình luận*/
    fb.graph(idStatus, 'comments', showComment, endShowComments, 'v2.10');
}

$(function() {
    fb = new FB('../../');
    fb.setToken($.cookie('token'));
    fb.checkLiveToken();



    // fb.graph();
});
$(function action() {
    $("#filter-comments").click(filterComments);
});