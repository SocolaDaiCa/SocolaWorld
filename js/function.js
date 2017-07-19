'use strict';
function show_list_groups(json, all) {
	var html ='';
	html+='<a href="//fb.com/'+all.groups.id+'" style="font-size: 20px; color: black;" target="_blank">'+all.groups.name+'</a><br>';
	html+='<img alt="image" src="https://graph.facebook.com/'+all.me.id+'/picture?type=large&redirect=true&width=20&height=20"/>&nbsp;';
	html+='<span class="small">'+all.me.name+'</span>';
	html+='<ul>';
	json.forEach(function(item) {
		item.email = item.email.split('@')[0];
		html+='<li>';
		if(item.id===all.group.id){
			html+='	<a class="crop active" href="../'+item.email+'/'+item.id+'" title="'+item.name+'">';
		}
		else{
			html+='	<a class="crop" href="../'+item.email+'/'+item.id+'" title="'+item.name+'">';
		}
		html+='		<img class="so1" src="'+item.icon+'" alt="">&nbsp;'+item.name;
		html+='	</a>';
		html+='</li>';
	});
	html+='</ul>';
	$('.list_groups').html(html);
}


