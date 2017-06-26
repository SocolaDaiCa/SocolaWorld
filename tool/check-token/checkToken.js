var liveToken;
var text;
var countToken, countLive, countDie;
var live = true, die = false;
$(document).ready(function() {

	$('#clear-result').click(function() {
		$('#result').html('');
	});

	$('#start-check').click(function() {
		var str_token = $('#token-input').val();
		if(str_token==='')
		{
			$('#result').html(
			'<div class="alert alert-danger">'+
			'	<strong>Warning!</strong> Không nhập gì thì sao mà chạy đc.'+
			'</div>');
			return ;
		}
		else
			$('#result').html('Đại ca đợi xíu, em đang kiểm tra.');
		var arr_token = str_token.split('\n');
		countLive = countDie = 0;
		countToken = arr_token.length;
		liveToken = [];
		$('#countToken').text(arr_token.length);
		arr_token.forEach(function(token, index) {
			$.getJSON('https://graph.facebook.com/v2.9/me',
				{fields: 'location,name',  access_token: token})
			.done(function(res) {
				countLive++;
				liveToken.push(token);
				text = '<span class="id">'+res.id+'</span>'+'| ';
				text+='<span class="name">'+res.name+'</span>';
				text+= ('location' in res) ? '| '+res.location.name : '|';
				text+='</tr>';
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
function showResultCheckToken(data, index, status) {
	if(status==live)
		$('#result').append('<li class="live">'+data+'</li>');
	else
		$('#result').append('<li class="die">'+data+'</li>');
	if( (countLive+countDie)==countToken)
	{
		$('#token-input').val(liveToken.join('\n'));
		$('#result').append('Đã xong, thưa đại ca. Live:'+countLive);
	}
	$("html, body").animate({ scrollTop: $(document).height() }, 0);
}