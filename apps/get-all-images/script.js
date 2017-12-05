'use strict';
var app = new Vue({
    el: "#app",
    data: {
        token: "",
        userID: "",
        listLink: []
    },
    methods: {
        get: function() {
            var fb = new FB("./");
            fb.setToken(this.token);
            fb.graph(this.userID, "posts.limit(10){id}", function(res1, obj) {
                res1.forEach(function(item1) {
                	// console.log(item1);
                    fb.graph(item1.id, "attachments.limit(10){media}", function(res2, obj2) {
                    	// console.log(res2);
                    	if(res2.length == 0) return;
                    	res2.forEach(function(item2) {
                    		// console.log(item2.media.image.src);
                    		app.listLink.push(item2.media.image.src);
                    	});
                    }, function() {}, "v2.5", {});
                });
            }, function() {}, "v2.5", {});
        }
    }
});
$(function() {
    // app.get();
})