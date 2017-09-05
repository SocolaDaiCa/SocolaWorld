/*fa fa-square-o*/
'use strict';
$(function () {
	$(".fa-check-square-o").click(function() {
		// body...
		// $(this).removeClass('fa-check-square-o');
		// $(this).addClass('fa-square-o');
		$(this).parent().parent().remove();
	});
});