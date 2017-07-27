'use strict';
var liveToken;
var text;
var countToken, countLive, countDie;
var live = true,
    die = false;
$(document).ready(function() {

    $('#clear-result').click(function() {
        $('#result').html('');
    });

    $('#start-check').click(function() {
        var strToken = $('#token-input').val();
        if (strToken === '') {
            $('#result').html(
                '<div class="alert alert-danger">' +
                '	<strong>Warning!</strong> Không nhập gì thì sao mà chạy đc.' +
                '</div>');
            return;
        } else {
            $('#result').html('Đại ca đợi xíu, em đang kiểm tra.');
        }
        var arr_token = strToken.split('\n');
        countLive = countDie = 0;
        countToken = arr_token.length;
        liveToken = [];
        $('#countToken').text(arr_token.length);
        arr_token.forEach(function(token, index) {
            $.getJSON('https://graph.facebook.com/v2.9/me', { fields: 'location,name', access_token: token })
                .done(function(res) {
                    countLive++;
                    liveToken.push(token);
                    text = `
						<span class="id">${res.id}</span> | <span class="name">${res.name}</span>
					`;
                    text += ('location' in res) ? '| ' + res.location.name : '|';
                    showResultCheckToken(text, index, live);
                })
                .fail(function(res) {
                    countDie++;
                    showResultCheckToken(res.responseJSON.error.message, index, die);
                });
        });
    });
    $('#unique').click(function() {
        var arrToken = $('#token-input').val().split('\n');
        arrToken = jQuery.unique(arrToken);
        $('#token-input').val(arrToken.join('\n'));
    });
});

function showResultCheckToken(text, index, status) {
    if (status === live) {
        $('#result-live').append(`${text} <br>`);
    } else {
        $('#result-die').append(`<span>${countDie}. ${text}<br></span>`);
        if(countDie > 10){
        	$('#result-die span:first-child').remove();
        }
    }
    if ((countLive + countDie) === countToken) {
        $('#token-input').val(liveToken.join('\n'));
        $('#result').html('Đã xong, thưa đại ca. Live:' + countLive);
    }
    $("html, body").animate({ scrollTop: $(document).height() }, 0);
}