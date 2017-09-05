$(function() {
	
	$('*[include]').each(function include() {
		var select = $(this);
		$.get(select.attr('include'), function(res) {
			select.replaceWith(res);
		});
	});

	$('a').each(function addTitle() {
		$(this).attr('title', $(this).text());
	});

	$('body').on('click','video', function playVideo() {
		if(this.paused) this.play();
		else this.pause();
	});

	if($('.checkConnect').length ===0)
		$('body').append('<div id="snackbar" class="checkConnect">Không thể kết nối internet</div>');

	setInterval(function checkConectInternet(){
		if(navigator.onLine===true){
			$('#snackbar').removeClass('show');
		}else{
			$('#snackbar').addClass('show');
		}
	}, 1000);

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
});