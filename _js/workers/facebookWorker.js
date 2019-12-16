// JavaScript Document
// This script will handle form submission data and deliver it to the social media network
// Facebook

console.log('Facebook form submission handler worker is active')

async function sendFbMsg(){
    $fbPostFetch = await fetch();
}

onmessage = function(formContentObject) {
  //console.log('Worker: Message received from main script');
  let result = formContentObject.data; 
    // Display the values
    //console.log('received object is ' + result ) ;
    console.log('received object is ' + JSON.stringify(result) ) ;
    let formConentObj = JSON.parse( JSON.stringify(result) );
    console.log( 'message is ' + formConentObj.postMessage );
    setTimeout(function(){ postMessage('Message sent aight'); }, 3000);
}