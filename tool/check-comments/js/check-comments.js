function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
var fb;
function showComments(json, all){
	var email = null;
	json.forEach(function(item, index) {
		arrTextInMessage = (item.message).split(" ");
		for(var x in arrTextInMessage)
		{
			if (validateEmail(arrTextInMessage[x])) {
				email = arrTextInMessage[x];
				break;
			}
		}
		if (email===null) return;
		var id = item.from.id;
		var name = item.from.name;
		var linkProfile = 'http://fb.com/'+id;
		var avatar = '<img src="https://graph.facebook.com/'+id+'/picture?type=large&redirect=true&width=40&height=40'+'" class="img-circle" alt="">';
		$('#result').append(
		'<tr>'+
		'	<td>'+
				(/*avatar+' '+*/item.from.name).link(linkProfile)+
		'	</td>'+
		'	<td>'+
				email+
				// item.message+
		'	</td>'+
		''+
		''+
		'</tr>'
		);
	});
}
$(function() {
	fb = new FB('../../');
	fb.setToken();
	$("#check-comments").click(function() {
		var idTarget = $("#id-post").val();
		var fields = 'comments.order(reverse_chronological)';
		var id = 'result';
		idTarget = fb.graphA(idTarget, 'id').id;
		console.log(idTarget);
		fb.graph(idTarget, fields, showComments, Null, id);
	});
});