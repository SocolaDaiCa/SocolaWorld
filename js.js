function load_ajax(div_id, id_groups, url){
	$.get(url, {id: id_groups}, function(result){
		$(div_id).html(result);
	});
}
function like(id) {
	id = '#'+id;
	if ($(id).css('color')=='rgb(0, 0, 0)')
		$(id).css('color', '#5890FF');
	else
		$(id).css('color', '');
}
function save(id) {
	id = '#'+id;
	if ($(id).text()=='Lưu bài viết')
		$(id).text('Bỏ lưu bài viết');
	else
		$(id).text('Lưu bài viết');
}
function report(id) {
	id = '#'+id;
	if ($(id).text()=='Bật thông báo cho bài viết này')
		$(id).text('Tắt thông báo cho bài viết này');
	else
		$(id).text('Bật thông báo cho bài viết này');
}
$(document).ready(function(){

	$(".save_post").click(function() {
		// if(this.value==0)
		// 	$("#"+this.id).text('bỏ lưu bài viết');
		this.value = 1;
	});
	// $(window).resize(function(){
 //    	console.log($(".bo_list_groups").width());
 //    	if ($(".bo_list_groups").width()>255)
 //    		$(".bo_list_groups").hide();
 //    	else
 //    		$(".bo_list_groups").show();
	// });
});