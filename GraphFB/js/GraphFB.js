'use strict';
function linkFB(target) {
	return `<a href="https://fb.com/${target.id}">${target.name}</a>`;
}
function showAvatar(status){
	return `
	<a href="https://fb.com/${status.from.id}" target="_blank">
		<img alt="image" src="https://graph.facebook.com/${status.from.id}/picture?type=large&redirect=true&width=40&height=40"/>
	</a>`;
}
function showStory(status, groups){
	var linkUser = '<a href="//fb.com/'+status.from.id+'" target="_blank"><b>'+status.from.name+'</b></a>';
	var linkGroup = linkFB(groups);
	if(!status.story){
		return `
		${linkUser} 
		<span class="glyphicon glyphicon-triangle-right text-muted" style="font-size:10px;"></span> 
		<b>${linkGroup}</b>`;
	}
	status.story = status.story.replace(status.from.name, linkUser+'<span class="text-muted">');
	status.story = status.story.replace(groups.name, linkGroup+'</span>');
	return status.story;
}
var Keo = ['\n', ' ', "[", "]", ',', '"'];
function cat(value, i){
	if(i<Keo.length)
	{
		var valuei= value.split(Keo[i]);
		valuei.forEach(function(item2, index2) {
			if(item2!==""){
				valuei[index2] = cat(item2, i+1);
			}
		});
		return valuei.join(Keo[i]);
	}
	else
	{
		if(value.search('http')===0){
			return '<a href="'+value+'" title="" target="_blank">'+value+'</a>';
		}
		if(value.search('www.')===0){
			return '<a href="//'+value+'" title="" target="_blank">'+value+'</a>';
		}
		if(value[0]==='#'){
			return '<a href="'+value+'" title="">'+value+'</a>';
		}
		return value;
	}
}
function showCreatTime(created_time) {
	var timeNow = new Date();
	var timeSince = new Date(created_time);
	var timeFor = (timeNow.getTime()/1000) - (timeSince.getTime()/1000);
	if(timeFor<60){
		return 'Vừa xong';
	}
	if(timeFor<3600){
		return parseInt(timeFor/60)+' phút';
	}
	if(timeFor<86400){
		return parseInt(timeFor/3600)+' giờ';
	}
	var stringTime ='';
	if(timeFor-timeNow.getHours()*3600-timeNow.getMinutes()*60-timeNow.getSeconds()<86400){
		stringTime += 'Hôm qua ';
	}
	else{
		stringTime += timeSince.getDate()+' tháng '+(timeSince.getMonth()+1)+' '+timeSince.getFullYear();
	}
	stringTime += ' lúc '+timeSince.getHours()+':'+timeSince.getMinutes();
	return stringTime;
}
function showMessage(status){
	if (!status.message){
		return '';
	}
	status.message = status.message.replace('</', '&lt;/').replace('/>', '&gt;/');
	var message=cat(status.message, 0);
	return message.replace('\n', '<br>');
}
function getCountComments(status) {
	if (status.comments && status.comments.summary){
		return status.comments.summary.total_count;
	}
	return 'cant count';
}
function showFullPicture(status){
	if(status.source){
		return '';
	}
	var url_image =  status.full_picture || status.picture || null;
	if(url_image===null){
		return '';
	}
	if(status.type==='link')
	{
		var description = status.description || '';
		var caption =  status.caption || '';
		return `
		<div class="di_link">';
			<a href="${status.link}" class="icon">';
				<img src="${url_image}">';
			</a>';
			<a href="${status.link}" class="chu_thich" target="_blank">';
				<b>${status.name}</b>';
				<p class="small">${description}</p>';
				<span class="small text-muted">${caption}</span>';
			</a>';
		</div>`;
	}
	else
	{
		return `
		<a href="${status.permalink_url}" target="_blank">';
			<img src="${status.full_picture}">
		</a>`;
	}
}
function showSource(value){
	if(!value.source){
		return '';
	}
	var html = '';
	if(value.source.search('https://www.youtube.com')>-1){
		var src = value.source.replace('?autoplay=1', '?autoplay=0');
		return '<iframe width="100%" height="270" src="'+src+'" frameborder="0" allowfullscreen></iframe>';
	}
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

function getAStatus(status, index, all) {
	return`
	<div class="post" id="_${status.id}">
		<div class="header_post">
			<div class="avatar">${showAvatar(status)}</div>
			<div class="story">
				<span>${showStory(status, all.groups)}</span>
				<br><a class="text-muted small" target="_blank" href="${status.permalink_url}">${showCreatTime(status.created_time)}</a>
			</div>
		</div>
		<div class="body_post">
			${showMessage(status)}
			${showFullPicture(status)}
			${showSource(status)}
		</div>
		<div class="footer_post">
			<div class="action">
				<a href="#/">
					<span id="${index}_like">
						<i class="fa fa-thumbs-up"></i>
						<b class="small">Thích</b>
					</span>
				</a>
				<a href="${status.permalink_url}" target="_blank">
					<span class="glyphicon glyphicon-comment"></span>
					<b class="small">Bình luận</b>
				</a>
				<a href="${status.permalink_url}" target="_blank">
					<span class="glyphicon glyphicon-share-alt"></span>
					<b class="small">Chia sẻ</b>
				</a>
			</div>
			<div class="rearction">
				<a href="#/" class="text-muted like">${status.likes.summary.total_count}</a>
				<a href="${status.permalink_url}" target="_blank" class="text-muted comment">
					${getCountComments(status)}
				</a>
			</div>
		</div>
	</div>
	`;
}
FB.prototype.setCover = function(){
	$.getJSON(this.link_graph+'v2.9'+'/'+this.group.id, 
		{
			fields       : 'cover',
			access_token : this.token,
		},
		function(json_cover) {
			var url_cover = json_cover.cover.source || '';
			$('.cover').css('background-image', 'url('+url_cover+')');
	});
};
FB.prototype.newsFeed = function(){
	var fields = 'feed.limit(15).since('+since+'){'+dk_post+'}';
	this.graph(this.group.id, fields, showNewsFeed, Null, 'newsfeed', 'v2.3', null);
};

function showNewsFeed(json, all) {
	var html ='';
	countPost+=json.length;
	json.forEach(function(status, index) {
		if(Date.parse(status.created_time)/1000 < since) return;
		html+=getAStatus(status, index, all);
	});
	$('#newsfeed').append(html);
}
/*FB.prototype*/