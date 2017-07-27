'use strict';
function Percent(lengthtMax, s) {
	var x ={
	    lengthtMax : lengthtMax,
	    lengthNow : 0,
	    lengthLast : 0,

	    percentNow : 0,
	    percentLast : 0,

		idPercent : s,
	    intervalShow : null,
	    end : false
	};
	this.callEnd = null;
    this.show = function() {
	    x.lengthLast = x.lengthNow;
	    x.percentNow = parseInt((x.lengthLast) / x.lengthtMax*100);
	    if (x.percentLast < x.percentNow) {
	        x.percentLast++;
	        $(x.idPercent).text(parseInt(x.percentLast) + "%");
	        bar1.set(parseInt(x.percentLast));
	    }
	    if (x.percentLast === x.percentNow && x.end === true) {
	        clearInterval(x.intervalShow);
	        $(x.idPercent).text("100%");
	        $('#count-friends').text("bạn bè: " + x.lengthNow + " người.");
	        $('#list-posts').click();

	    }
	};
	this.setLengthNow = function(lengthNow) {
		x.lengthNow = lengthNow;
	};
	this.uplengthNow = function(up){
		x.lengthNow += up;
	};
	this.start = function() {
	    x.intervalShow = setInterval(this.show, 20);
	};
	this.setCallEnd = function(callEnd) {
	    x.callEnd = callEnd;
	};
	this.end = function(){
		x.end = true;
	};
    return this;
}
// Percent.prototype.setLengthNow = function(lengthNow) {
// 	x.lengthNow = lengthNow;
// 	// console.log('setLengthNow');
// };


// Percent.prototype.show = function() {
// 	console.log('show'+this.idPercent);
// 	// $(this.idPercent).text("ngu");
//     this.lengthLast = this.lengthNow;
//     this.percentNow = parseInt((this.lengthLast) / this.lengthtMax);
//     if (this.percentLast < this.percentNow) {
//         this.percentLast++;
//         $(this.idPercent).text(parseInt(this.percentLast) + "%");
//     }
//     if (this.percentLast === this.percentNow && this.end === true) {
//         clearInterval(this.intervalShow);
//         $(this.idPercent).text("100%");
//         $('#count-friends').text("bạn bè: " + this.lengthNow + " người.");
//         $('#list-posts').click();
//     }
// };
// Percent.prototype.start = function() {
//     // $(this.idPercent).show();
//     x.intervalShow = setInterval(function() {
//     	return x.show();
//     }, 20);
//     console.log('start');
// };