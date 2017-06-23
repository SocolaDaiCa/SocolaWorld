function show_list_groups(json, all) {
	var html ='';
	html+='<a href="//fb.com/'+all.groups.id+'" style="font-size: 20px; color: black;" target="_blank">'+all.groups.name+'</a><br>';
	html+='<img alt="image" src="https://graph.facebook.com/'+all.me.id+'/picture?type=large&redirect=true&width=20&height=20"/>&nbsp;';
	html+='<span class="small">'+all.me.name+'</span>';
	html+='<ul>';
	json.forEach(function(item, index) {
		item.email = item.email.split('@')[0];
		html+='<li>';
		if(item.id==all.group.id)
			html+='	<a class="crop active" href="../'+item.email+'/'+item.id+'" title="'+item.name+'">';
		else
			html+='	<a class="crop" href="../'+item.email+'/'+item.id+'" title="'+item.name+'">';
		html+='		<img class="so1" src="'+item.icon+'" alt="">&nbsp;'+item.name;
		html+='	</a>';
		html+='</li>';
	});
	html+='</ul>';
	$('.list_groups').html(html);
}
function linkFB(target) {
	return '<a href="https://fb.com/'+target.id+'">'+target.name+'</a>';
}
function showAvatar(status){
	var html = '<a href="https://fb.com/'+status.from.id+'" title="" target="_blank">';
	html+='<img alt="image" src="https://graph.facebook.com/'+status.from.id+'/picture?type=large&redirect=true&width=40&height=40"/> ';
	html+='</a>';
	return html;
}
function showStory(status, groups){
	var linkUser = '<a href="//fb.com/'+status.from.id+'" target="_blank"><b>'+status.from.name+'</b></a>';
	var linkGroup = linkFB(groups);
	if(!status.story)
		return linkUser+' <span class="glyphicon glyphicon-triangle-right text-muted" style="font-size:10px;"></span> <b>'+linkGroup+'</b>';
	status.story = status.story.replace(status.from.name, linkUser+'<span class="text-muted">');
	status.story = status.story.replace(groups.name, linkGroup+'</span>');
	return status.story;
}
function showCreatTime(created_time) {
	var timeNow = new Date();
	var timeSince = new Date(created_time);
	var timeFor = (timeNow.getTime()/1000) - (timeSince.getTime()/1000);
	if(timeFor<60)    return 'Vừa xong';
	if(timeFor<3600)  return parseInt(timeFor/60)+' phút';
	if(timeFor<86400) return parseInt(timeFor/3600)+' giờ';
	var stringTime ='';
	if(timeFor-timeNow.getHours()*3600-timeNow.getMinutes()*60-timeNow.getSeconds()<86400)
		stringTime += 'Hôm qua ';
	else
		stringTime += timeSince.getDate()+' tháng '+(timeSince.getMonth()+1)+' '+timeSince.getFullYear();
	stringTime += ' lúc '+timeSince.getHours()+':'+timeSince.getMinutes();
	return stringTime;
}
function showMessage(status){
	if (!status.message) return '';
	status.message = status.message.replace('</', '&lt;/').replace('/>', '&gt;/');
	var message=cat(status.message, 0);
	return message.replace('\n', '<br>');
}
function showFullPicture(status){
	if(status.source)	return '';
	var html ='';
	var url_image =  status.full_picture || status.picture || null;
	if(url_image===null) return '';
	if(status.type=='link')
	{
		var description = status.description || '';
		var caption =  status.caption || '';
		html+='	<div class="di_link">';
		html+='		<a href="'+status.link+'" class="icon">';
		html+='			<img src="'+url_image+'">';
		html+='		</a>';
		html+='		<a href="'+status.link+'" class="chu_thich" target="_blank">';
		html+='			<b>'+status.name+'</b>';
		html+='			<p class="small">'+description+'</p>';
		html+='			<span class="small text-muted">'+caption+'</span>';
		html+='		</a>';
		html+='	</div>';
	}
	else
	{
		html+='	<a href="'+status.permalink_url+'" target="_blank">';
		html+='		<img src="'+status.full_picture+'"></a>';
	}
	return html;
}
function showSource(value){
	if(!value.source) return '';
	var html = '';
	if(value.source.search('https://www.youtube.com')>-1)
		html+='<iframe width="100%" height="270" src="'+value.source.replace('?autoplay=1', '?autoplay=0')+'" frameborder="0" allowfullscreen></iframe>';
	else
	{
		// html+='<div class="anhzz">';
		// html+='	<img src="'+value.full_picture+'" class="anh1">';
		// html+='		<div class="anh2">';
		html+='			<video class="center-block" controls>';
		html+='				<source src="'+value.source+'" type="video/mp4">';
		html+='			</video>';
		// html+='		</div>';
		// html+='</div>';
	}
	return html;
}
var Keo = ['\n', ' ', "[", "]", ',', '"'];
function cat(value, i){
	if(i<Keo.length)
	{
		var valuei= value.split(Keo[i]);
		valuei.forEach(function(item2, index2) {
			if(item2!=="")
				valuei[index2] = cat(item2, i+1);
		});
		return valuei.join(Keo[i]);
	}
	else
	{
		if(value.search('http')===0)
			return '<a href="'+value+'" title="" target="_blank">'+value+'</a>';
		if(value.search('www.')===0)
			return '<a href="//'+value+'" title="" target="_blank">'+value+'</a>';
		if(value[0]=='#')
			return '<a href="'+value+'" title="">'+value+'</a>';
		return value;
	}
}