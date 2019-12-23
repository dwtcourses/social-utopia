// JavaScript Document
// URL Clean Up
$(document).ready(function () {
	if (window.location.href.indexOf('#_=_') > 0) {
		window.location = window.location.href.replace(/#.*/, '');
	}
});

function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(len + ' characters of 280 (Twitter Max).');
         //$('#charNum').text(len + ' characters of 280 (Twitter Max). ' + (280 - len) + ' remaining');
        }
      }

function fbPgSelectorChange(selectObject){
    //alert(selectObject.value);
    window.location.href = "./?manageSelectedFacebookPage=" + selectObject.value;
}