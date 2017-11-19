var app = new Vue({
    el: "#app",
    data: {
        calendar: [],
        day: "",
        ca: "",
        date: "",
        lydo: "",
        res: ""
    },
    methods:{
    	set: function(ca, day, date) {
    		this.day = day;
    		this.ca = ca;
    		this.date = date;
    	},
    	registration: function() {
    		$.post("/API/bot.php", {
    			day: this.day,
    			ca: this.ca,
    			lydo: this.lydo
    		}, function(res) {
    			
    		})
    	}
    },
    created: function() {

    }
});
$(function() {
    $.getJSON("/API/bot.php?q=get_list_calendar", function(calendar) {
    	app.calendar = calendar;
    });
});