/*
 * @Author: Socola
 * @Date:   2018-02-01 20:03:32
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-24 14:39:12
 */
'use strict';
const app = new Vue({
	el: '#app',
	data: {
		all: '?',
		live: '?',
		die: '?',
		tokens: '',
	},
	methods: {
		check: function() {
			toastr.remove();
			this.all = this.live = this.die = this.hadCheck = this.totalProcess = 0;
			var tokens, tokenLives = [];
			var totalProcess = 0;
			var index = 0;
			var maxProcess = 100;
			var endPoint = 'https://graph.facebook.com/v2.9/me';

			var checkToken = () => {
				console.log(index);
				if(index == tokens.length){
					this.tokens = tokenLives.join('\n');
					index++;
					toastr.remove();
					return toastr.success('Đã xong, thưa đại ca');
				}

				if(totalProcess > maxProcess || index >= tokens.length){
					return;
				}

				var token = tokens[index++];
				let data = { fields: 'location,name', 'access_token': token };
				$.getJSON(endPoint, data).done(() => {
					this.live++;
					tokenLives.push(token);
				}).fail(() => this.die++).always((res) => {
					totalProcess--;
					return checkToken();
				}); 
			};
			console.log(this.tokens);
			this.tokens = this.tokens.trim();
			console.log(this.tokens);
			if(this.tokens != ""){

				toastr.info('Đại ca đợi xíu, nhanh thôi.');
				tokens = this.tokens.split('\n');
				// console.log(tokens);
				this.all = tokens.length;

				for(var i = 1; i <= maxProcess && i <= tokens.length; i++){
					checkToken();
				}
				return;
			}

			var fileInput = document.getElementById('tokenfile');
			if(fileInput.files.length === 0){
				return toastr.error('Không nhập gì thì sao chạy.');
			}
			var file = fileInput.files[0];
			
			var reader = new FileReader();
			reader.onload = function(e) {
				console.log(reader.result);
				tokens = reader.result.split('\n');
				for(var i = 1; i <= maxProcess && i <= tokens.length; i++){
					checkToken();
				}
			};
			reader.readAsText(file);
		}
	}
});
$(document).ready(function() {
	$('#unique').click(function() {
		var arrToken = $('#token-input').val().split('\n');
		arrToken = jQuery.unique(arrToken);
		$('#token-input').val(arrToken.join('\n'));
	});
});
var clipboard = new Clipboard('.btn');
clipboard.on('success', function(e) {
	console.log(e);
});
clipboard.on('error', function(e) {
	console.log(e);
});