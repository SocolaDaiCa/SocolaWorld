'use strict';
var liveToken;
var text;
var countToken, countLive, countDie;
var live = true,
    die = false;
const app = new Vue({
    el: '#app',
    data: {
        all: '?',
        live: '?',
        die: '?',
        listTokens: '',
        tokenLive: [],
        res: []
    },
    methods: {
        check: function() {
            this.all = this.live = this.die = 0;
            if (this.listTokens == '') {
                return toastr.error('Không nhập danh sách token thì sao lọc');
            }
            toastr.info('Đại ca đợi xíu, nhanh thôi.');
            let tokens = this.listTokens.split('\n');
            this.all = tokens.length;
            let endPoint = 'https://graph.facebook.com/v2.9/me';
            tokens.forEach(function(token) {
                let data = { fields: 'location,name', access_token: token };
                $.getJSON(endPoint, data)
                    .done(function(res) {
                        app.live++;
                        app.tokenLive.push(token);
                    }).fail(function(res) {
                        app.die++;
                    }).always(function(res) {
                        app.res.push(JSON.stringify(res));
                        if(app.all == app.live + app.die)
                            toastr.success('Đã xong, thưa đại ca');
                    });
            });
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

function showResultCheckToken(text, index, status) {
    if (status === live) {
        $('#result-live').append(`${text} <br>`);
    } else {
        $('#result-die').append(`<span>${countDie}. ${text}<br></span>`);
        if (countDie > 10) {
            $('#result-die span:first-child').remove();
        }
    }
    if ((countLive + countDie) === countToken) {
        $('#token-input').val(liveToken.join('\n'));
        $('#result').html('Đã xong, thưa đại ca. Live:' + countLive);
    }
    // $("html, body").animate({ scrollTop: $(document).height() }, 0);
}
var clipboard = new Clipboard('.btn');
clipboard.on('success', function(e) {
    console.log(e);
});
clipboard.on('error', function(e) {
    console.log(e);
});