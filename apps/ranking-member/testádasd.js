'use strict';
function x() {
	this.a = "sốdsa";
}
x.prototype.hi = function() {
	var sd= 10;
};
var a = new x();
console.log(a);