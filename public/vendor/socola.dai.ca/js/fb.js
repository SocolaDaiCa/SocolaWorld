/*
 * @Author: Socola
 * @Date:   2018-02-01 20:05:18
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-23 17:59:13
 */
'use strict';
var me;
function saveInfoOfMeAndLog(info) {
	me = info;
	console.log('Token live');
}
function showError(error) {
	console.log(error);
}
function FacebookGraph(pathRoot) {
	/*var*/
	this.pathRoot = pathRoot;
	this.token = null;
	/*function*/
	this.setToken = function(token) {
		this.token = token;
	};
	this.checkLiveToken = function() {
		$.ajaxSetup({ "async": false });
		var url = `https://graph.facebook.com/v2.3/me?fields=name`;
		var data = {access_token: this.token};
		$.getJSON(url, data)
			.done(saveInfoOfMeAndLog)
			.fail(showError);
		$.ajaxSetup({ "async": true });
	};
	this.graphA = function(idTarget, fields, version) {
		$.ajaxSetup({ "async": false });
		var url = `https://graph.facebook.com/${version}/${idTarget}`;
		console.log(url);
		var data = {access_token: this.token, fields};
		console.log(JSON.stringify(data));
		var result;
		$.getJSON(url, data)
			.done(function(res) {
				result = res;
			})
			.fail(showError);
		$.ajaxSetup({ "async": true });
		return result;
	};
	this.graphAS = function(idTarget, query, version) {
		var url = `https://graph.facebook.com/${version}/${idTarget}?${query}&access_token=${this.token}`;
		// var result;
		$.getJSON(url)
			.done(function(res) {
				// result = res;
			})
			.fail(showError);
		// return result;
	};
	this.graph = function(idTarget, fields, action, actionEnd, version, obj){
		(!version) && (version = 'v2.10');
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
		}).fail(showError);
	};
}
function graphNext(next, action, actionEnd, obj) {
	$.getJSON(next, function(res) {
		action(res.data, obj);
		if (res.paging && res.paging.next){
			return graphNext(res.paging.next, action, actionEnd, obj);
		}
		return actionEnd();
	}).fail(showError);
}