// external js: masonry.pkgd.js, imagesloaded.pkgd.js

// init Masonry after all images have loaded
// var $grid = $('.grid').imagesLoaded( function() {
//   $grid.masonry({
//     itemSelector: '.grid-item',
//     percentPosition: true,
//     columnWidth: '.grid-sizer'
//   }); 
// });
'use strict';
const app = new Vue({
	el: '#app',
	data: {
		images: []
	},
	methods: {
		loadMore: function() {
			
		};
	}
});
$(function() {
	$(window).scroll(function() {
		let documentHeight = $(document).height();
		let windowHeight = $(window).height();
		let scrollheight = $(window).scrollTop();
		
	});
});