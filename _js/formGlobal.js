// JavaScript Document
// AJAX Call to Send Message
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
// Prevent form from auto submitting and changing page
  e.preventDefault();
    if (window.Worker) {
        // Start web workers
        let fbWorker = new Worker('./_js/workers/facebookWorker.js');
        // Send information to worker
        fbWorker.postMessage({ 'testItem' : 'true that'});
        
        // Get information from worker
        fbWorker.onmessage = function(e) {
            console.log('Message received from worker: ' + e.data);
            fbWorker.terminate();
            console.log('Worker terminated');
        } // End worker message response function
    } // End if window.worker


  $.ajax({
         url: "app.handler.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {

     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#form")[0].reset(); 
 
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});





/*
$("#sendMessageBtn").click(function(){
	if ( $("#facebokPageId").val() == 'false' ){
		alert ( 'Please select page to post to' );
	} else {
		if ( $("#postMessage").val() != '') {	
		  $.post("app.handler.php",
		  {
			facebokPageId: 		$("#facebokPageId").val(),
			facebookToken: 		$("#facebookToken").val(),
			twitterToken: 		$("#twitterToken").val(),
			postMessage: 		$("#postMessage").val(),
			linkURL: 			$("#linkURL").val()
		  },
		  function(data, status){
			alert("Data: " + data + "\nStatus: " + status);
		  });
		} else alert ( 'Post Message is Empty' );	
	}
});*/