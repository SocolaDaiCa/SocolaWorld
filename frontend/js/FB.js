'use strict';
var arr_dieu_kien = [
    'from',
    'story',
    'created_time',
    'message',
    'full_picture',
    'type',
    'link',
    'picture',
    'name',
    'description',
    'caption',
    'source',
    'likes.summary(true).limit(0){total_count}',
    'comments.summary(true).limit(0){total_count}',
    'permalink_url',
];
var since = parseInt(Date.now() / 1000) - 48 * 3600;
var dk_post = arr_dieu_kien.toString();
var countPost = 0;

function FB(path) {
    this.me = {};
    this.link_graph = 'https://graph.facebook.com/';
    this.path_show_error = path;
    this.json = '';
    this.json_string = '';
    /**/
    this.group = {};
    this.token = null;
    /**/
    this.getIdFromUrl = function() {
        this.group.id = (document.URL.split('/')).pop();
    };
    this.setId = function(id) {
        this.group.id = id;
    };
    this.setToken = function() {
        $.ajaxSetup({ "async": false });
        this.token = $.cookie('token') || this.token;
        var json;
        $.getJSON(this.link_graph + 'v2.9/me', { access_token: this.token },
            function(res) { json = res; });
        this.me = json;
        $.getJSON(this.link_graph + 'v2.3/' + this.group.id, {
            fields: 'name',
            access_token: this.token
        }, function(res) { json = res; });
        this.groups = json;
        // if('name' in this.groups)
        // 	document.title = this.groups.name;
        $.ajaxSetup({ "async": true });
    };
    this.listGroups = function() {
        var fields = 'groups.limit(50){picture,name,email,icon}'; /*{,,privacy,,picture}*/
        this.graph('me', fields, show_list_groups, Null, '', 'v2.3', null);
    };
    this.listMembers = function(id) {
        var fields = 'members.limit(500){name,link}';
        this.graph(fields, showListMembers, Null, 'listMenbers', 'v2.3', null);
    };
    this.graphA = function(idTarget, fields) {
        $.ajaxSetup({ "async": false });
        var json;
        $.getJSON('https://graph.facebook.com/v2.3/' + idTarget, {
                fields: fields,
                access_token: this.token
            },
            function(res) {
                console.log(res);
                json = res;
            });
        $.ajaxSetup({ "async": true });
        return json;
    };
    return this;
}
FB.prototype.graph = function(idTarget, fields, action, actionElse, id, v, obj) {
    var all = this;
    if (v === null) {
    	v = 'v2.3';
    }
    $.getJSON(`https://graph.facebook.com/${v}/${idTarget}`, {
            fields: fields,
            access_token: this.token
        },
        function(res) {
            var field = Object.keys(res)[0];
            var json = res[field].data;
            $('#' + id).html('');
            action(json, all, obj);
            if (res[field].paging && res[field].paging.next){
                return graphNext(res[field].paging.next, action, actionElse, all, obj);
            }
            return actionElse();
        });
};

function graphNext(next, action, actionElse, all, obj) {
    $.getJSON(next, function(res) {
        action(res.data, all, obj);
        if (res.paging && res.paging.next){
            return graphNext(res.paging.next, action, actionElse, all, obj);
        }
        return actionElse();
    });
}

function Null() {}
