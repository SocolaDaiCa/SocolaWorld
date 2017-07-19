'use strict';
// var
var percent /*= new Percent(leng_max, '#percent')*/ ;
var post, postLike, postComment, endPost;
var intervalPost;
var listFriends = null;
var leng_max = 0;
var leng_now = 0;
var htmlFriend =
    '<tr id="{id-friend}">' +
    '<td></td>' +
    '<td>{name}</td>' +
    '<td>{reaction}</td>' +
    '<td>{comments}</td>' +
    '<td>{score}</td>' +
    '</tr>';
var htmlPost =
    '<tr>' +
    '<td class="index"></td>' +
    '<td><a href="//fb.com/{id}" target="_blank">{id}</a></td>' +
    '</tr>';
// fun
function Friend(id, name) {
    this.id = id;
    this.name = name;
    this.like = 0;
    this.comments = 0;
    this.actionLike = function() {
        this.like++;
    };
    this.upActionLike = function(count) {
        this.like+=count;
    };
    this.countLike = function() {
        return this.like;
    };
    this.actionComments = function() {
        this.comments++;
    };
    this.upActionComments = function(count) {
        this.comments+= count;
    };
    this.countComments = function() {
        return this.comments;
    };
    this.getName = function() {
        return this.name;
    };
    this.getId = function() {
        return this.id;
    };
    return this;
}
// action list friend
function actionListFriends(json) {
    leng_now += json.length;
    percent.setLengthNow(leng_now);
    json.forEach(function(item) {
        listFriends['_' + item.id] = new Friend(item.id, item.name);
        // var name = item.name;
        // var html = htmlFriend
        //     .replace('{id-friend}', '_' + item.id)
        //     .replace('{name}', name)
        //     .replace('{reaction}', 'loading...')
        //     .replace('{comments}', 'loading...')
        //     .replace('{score}', 'loading...');
        // $('#result-listfriends').append(html);
    });
}

function endActionListFriends() {
    percent.end();
}
// action list post
function endActionLike() {
    postLike++;
}
function actionLike(json, all, obj) {
    if (!json) {
        return;
    }
    if (listFriends['_' + obj.id]) {
        listFriends['_' + obj.id].upActionLike(json.length);
    }
    json.forEach(function(item) {
        if (listFriends['_' + item.id]) {
            listFriends['_' + item.id].actionLike();
        }
    });
}
function endActionComments() {
    postComment++;
}
function actionComments(json, all, obj) {
    if (!json) {
        return;
    }
    if (listFriends['_' + obj.id]) {
        listFriends['_' + obj.id].upActionComments(json.length);
    }
    json.forEach(function(item) {
        if (listFriends['_' + item.from.id]) {
            listFriends['_' + item.from.id].actionComments();
        }
    });
}

function endActionListPosts() {
    endPost = true;
}

function actionListPosts(json) {
    if (json.length > 0) {
        json.forEach(function(item) {
            // var html = htmlPost.replace(/{id}/g, item.id);
            // $('#result-id-post').append(html);
            var obj = {id: item.from.id};
            fb.graph(item.id, 'reactions.limit(250){from{id}}', actionLike, endActionLike, 'null', 'v2.6', obj);
            fb.graph(item.id, 'comments.limit(250){from{id}}', actionComments, endActionComments, 'null', 'v2.3', obj);
        });
        post += json.length;
    }
}

function showResult() {
    console.log(` ${post} ${postLike} ${postComment} ${endPost}`);
    if (post === postLike && post === postComment && endPost === true) {
        clearInterval(intervalPost);
        console.log('end');
        $('#result-listfriends').html('');
        var arrFriends = [];
        $.each(listFriends, function(i, n) {
            arrFriends.push(n);
        });
        arrFriends.sort(function(a, b) {
            return (b.countComments() * 3 + b.countLike()) - (a.countComments() * 3 + a.countLike());
        });
        arrFriends.forEach(function(item, index) {
            if (index > 100) {
                return;
            }
            var score = item.countLike() + item.countComments() * 3;
            var linkProfile = (item.getName()).link('https://fb.com/' + item.getId());
            var html = htmlFriend
                .replace('{id-friend}', '_' + item.getId())
                .replace('{name}', linkProfile)
                .replace('{reaction}', item.countLike())
                .replace('{comments}', item.countComments())
                .replace('{score}', score);
            $('#result-listfriends').append(html);
        });
    }
}
$(function createVar() {

});

$(function() {
    $("#list-friends").click(function() {
        listFriends = {};
        leng_max = fngetCountFriends();
        percent = new Percent(leng_max, '#percent');
        percent.start();
        fb.graph(idTarget, queryGetFriends, actionListFriends, endActionListFriends, 'result-listfriends', 'v2.3');
    });

    $('#list-posts').click(function() {
        intervalPost = setInterval(showResult, 1000);
        post = 0;
        postLike = 0;
        postComment = 0;
        endPost = false;
        fb.graph(idTarget, queryGetPosts, actionListPosts, endActionListPosts, 'result-id-post', 'v2.3');
    });
});
