'use strict';
function Group(groupId) {
	this.groupId = '';
	this.access_token = '';
}
var fb;
var app = new Vue({
    el: "#app",
    data: {
        modal1: {},
        modal2: {groupName: ''},
        listGroups: {},
        listBots: {},
        hashTag: '',
        messages: '',
        curentGroupId: ''
    },
    created: function() {
        fb = new FB('./');
        fb.setToken($.cookie('token'));
        fb.checkLiveToken();
        this.getListBots();
    },
    methods: {
        getListBots: function() {
            this.$set('listBots[' + me.id + ']', {
                'access_token': fb.token,
                'name': me.name,
                'id': me.id
            });
            $.getJSON(`https://graph.facebook.com/me/accounts?access_token=${fb.token}`, function(listBots) {
                listBots.data.forEach(function(bot) {
                    app.$set('listBots[' + bot.id + ']', {
                        name: bot.name,
                        access_token: bot.access_token,
                        id: bot.id
                    });
                });
                app.getListGroups();
            });
        },
        getListGroups: function() {
            let firstBot = Object.keys(app.listBots)[0];
            fb.graph('me', 'groups.limit(1000){name,icon}', function(listGroups) {
                listGroups.forEach(function(group) {
                    group.active = false;
                    group.hashTag = '';
                    group.bot = firstBot;
                    app.$set('listGroups[' + group.id + ']', group);
                });
                app.getData();
            }, function() {}, 'v2.3');
        },
        getData: function() {
            $.getJSON('actions/get-data.php', function(listBots) {
                listBots.forEach(function(record) {
                    if (app.listGroups[record[0]]) {
                        app.listGroups[record[0]].bot = record[1];
                        app.listGroups[record[0]].active = record[2] === '1';
                        app.listGroups[record[0]].hashTag = record[3];
                        app.listGroups[record[0]].messages = record[4];
                    }
                    // console.log(bot);
                    // // let page = JSON.parse(bot[1]);
                    // console.log(app.listBots[page.id]);
                    // if(app.listBots[page.id] && app.listGroups[bot[0]]){
                    // 	console.log('ơ rê ca');
                    // };

                    // 	if(app.keys['g_' + bot[0]] && listBots.indexOf(page) !== -1){
                    // 		let index = app.keys['g_' + bot[0]];
                    // 		app.listGroups[index].bot = app.listBots[0];
                    // 		console.log('ngu');
                    // 	}
                    // 	// if(bot[0])
                    // 	console.log(bot);
                    // 	// console.log(bot[0]);
                    // });
                    // app.listGroups.forEach(function(index, group) {
                    // 	// let index = app.keys[group.id];
                });
            });
        },
        setBot: function(groupId) {
            app.listGroups[groupId].active = true;
            app.saveBot(groupId);
        },
        removeBot: function(groupId) {
            app.listGroups[groupId].active = false;
            app.saveBot(groupId);
        },
        saveBot: function(groupId) {
            let group = app.listGroups[groupId];
            let token = app.listBots[group.bot].access_token;
            $.post('actions/save-bot.php', { group, token }, function(string) {
                console.log(string);
                let res = JSON.parse(string);
                console.log(res);
                // if(!res.success){
                //     app.listGroups[group.id].active = 1 - app.listGroups[group.id].active;
                // }
                
            });
        },
        // edit
        editHashtags: function(groupId) {
        	app.curentGroupId = groupId;
        	app.hashTag = app.listGroups[groupId].hashTag;
        },
        editMessages: function(groupId) {
            console.log(groupId);
            app.curentGroupId = groupId;
            app.messages = app.listGroups[groupId].messages;
        },
        // save
        saveHashtag: function() {
        	app.listGroups[app.curentGroupId].hashTag = app.hashTag;
        	app.saveBot(app.curentGroupId);
        },
        saveMessages: function() {
            app.listGroups[app.curentGroupId].messages = app.messages;
            app.saveBot(app.curentGroupId);
        }
    }
});