var app = new Vue({
    el: "#app",
    data: {
        token: "EAACW5Fg5N2IBACiXZA4kDCaSI80PXzZBoWxD9uuk1RimGI4Iqx96q6JSJ9ZCOizdxLpW0su4ZAa7qPRmJXfZCSgAIGJ8cbuOBeTfH762yzFWeL1iFg38Kqq3VaAyH97DctE9wsPG0zthXx0cEwnmL98rimJim071T6U6a51J8pwTZCldlR1OHSSk5Q177B0qnpniZChZB5oPGgZDZD",
        userID: "100016295920663",
        listLink: ""
    },
    methods: {
        get: function() {
            var fb = new FB("./");
            fb.setToken(this.token);
            fb.graph(this.userID, "posts.limit(1000){id}", function(res1, obj) {
                res1.forEach(function(item1) {
                	// console.log(item1);
                    fb.graph(item1.id, "attachments.limit(1){media}", function(res2, obj2) {
                    	console.log(res2);
                    // 	// res2.forEach(function(item2) {
                    // 		// console.log(item2);
                    // 		app.listLink += item2.media.image.src + "\n";
                    // 	// });
                    }, function() {}, "v2.5", {});
                });
            }, function() {}, "v2.5", {});
        }
    }
});
$(function() {
    app.get();
})