// JavaScript Document
// URL Clean Up
$(document).ready(function () {
	if (window.location.href.indexOf('#_=_') > 0) {
		window.location = window.location.href.replace(/#.*/, '');
	}
});