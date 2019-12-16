// JavaScript Document
// This script will handle form submission data and deliver it to the social media network
// Facebook

console.log('Facebook form submission handler worker is active')

async function sendFbMsg(){
    $fbPostFetch = await fetch();
}

onmessage = function(e) {
  //console.log('Worker: Message received from main script');
  let result = e.data.testItem;
    console.log(result);
    setTimeout(function(){ postMessage('Message sent aight'); }, 3000);
}