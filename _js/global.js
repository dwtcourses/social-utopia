// JavaScript Document
// URL Clean Up
$(document).ready(function () {
	if (window.location.href.indexOf('#_=_') > 0) {
		window.location = window.location.href.replace(/#.*/, '');
	}
});

function countChar() {
        let textBox = document.getElementById('postMessage');
        let linkURL = document.getElementById('linkURL');
    
        var lenTextBox = textBox.value.length;
        var lenLinkURL = linkURL.value.length;
    
        var lenSum = lenTextBox + lenLinkURL;
    
        if (lenSum >= 500) {
          textBox.value = textBox.value.substring(0, 500);
        } else {
          $('#charNum').text(lenSum + ' text box characters of 280 (Twitter Max)');
         //$('#charNum').text(len + ' characters of 280 (Twitter Max). ' + (280 - len) + ' remaining');
        }
      }

function fbPgSelectorChange(selectObject){
    //alert(selectObject.value);
    window.location.href = "./?manageSelectedFacebookPage=" + selectObject.value;
}