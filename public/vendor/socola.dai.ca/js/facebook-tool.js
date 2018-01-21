'use strict';
function shareOnFacebook(url, title, width, height) {
	url = `https://www.facebook.com/sharer/sharer.php?u=${url}`
	title = title || 'Share on Facebook';
	width = width || 100;
	height = height || 100;
	window.open(url, title, `width=${width}, height=${height}`);
}
