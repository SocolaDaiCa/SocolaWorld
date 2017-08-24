'use strict';
var me;
function saveInfoOfMeAndLog(info) {
	me = info;
	console.log('Token live');
}
function showError(error) {
	error = error.responseJSON.error;
	console.log(error.message);
}
function FB(pathRoot) {
	/*var*/
	this.pathRoot = pathRoot;
	this.token = null;
	/*function*/
	this.setToken = function(token) {
		this.token = token;
	};
	this.checkLiveToken = function() {
		$.ajaxSetup({ "async": false });
		var url = `https://graph.facebook.com/v2.3/me`;
		var data = {access_token: this.token};
		$.getJSON(url, data)
			.done(saveInfoOfMeAndLog)
			.fail(showError);
		$.ajaxSetup({ "async": true });
	};
	this.graphA = function(idTarget, fields, version) {
		$.ajaxSetup({ "async": false });
		var url = `https://graph.facebook.com/${version}/${idTarget}`;
		var data = {access_token: this.token, fields};
		var result;
		$.getJSON(url, data)
			.done(function(res) {
				result = res;
			})
			.fail(showError);
		$.ajaxSetup({ "async": true });
		return result;
	};
	this.graph = function(idTarget, fields, action, actionEnd, version, obj){
		if(!version){
			version = 'v2.10';
		}
		var field = fields.split('.')[0];
		var data = { 'fields': fields, 'access_token': this.token};
		var url = `https://graph.facebook.com/${version}/${idTarget}`;
		$.getJSON(url, data, function(res) {
			if(!res[field]){
				return actionEnd();
			}
			if(res[field] && res[field].data){
				action(res[field].data, obj);
			}
            if (res[field].paging && res[field].paging.next){
                return graphNext(res[field].paging.next, action, actionEnd);
            }
            return actionEnd();
		});
	};
}
function graphNext(next, action, actionEnd, obj) {
    $.getJSON(next, function(res) {
    	action(res.data, obj);
        if (res.paging && res.paging.next){
            return graphNext(res.paging.next, action, actionEnd, obj);
        }
        return actionEnd();
    });
}