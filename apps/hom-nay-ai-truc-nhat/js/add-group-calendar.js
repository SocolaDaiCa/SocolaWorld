'use strict';
var fb;
var app = new Vue({
    el: "#app",
    data: {
        listGroups: []
    },
    methods: {
        getListGroups: function() {
            fb.graph("me", "groups.limit(1000){name,administrator}", function(listGroups) {
                    listGroups.forEach(function(group) {
                        if (group.administrator) {
                            app.listGroups.push(group);
                        }
                    });
                }, function() {
                	console.log(JSON.stringify(app.listGroups));
                }, "v2.3");
        }
    },
    created: function() {},
    computed: {}
});
$(function() {
    fb = new FB("./");
    fb.setToken($.cookie("token"));
    fb.checkLiveToken();
    app.getListGroups();
});