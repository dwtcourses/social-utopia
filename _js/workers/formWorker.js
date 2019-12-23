// JavaScript Document
// This script will handle form submission data and deliver it to the social media network
// Facebook

console.log('New form worker started');
const host = '../../';

// Function will send form data to server and then response back to main thread
async function sendFbMsg(formConentObj){
    // Try to post information via postData() set below
    try {
        // Wait for information to be sent via postData() and store response
        const data = await postData(host + '/app.handler.php', formConentObj);
        // Process response to a text string
        data.text().then(function (text) {
          // send text response back to main thread
          postMessage(text);
            console.log(text);
        });
    } catch (error) {
        // If there is an error, log it to the console
        console.error(error);
    }

    async function postData(url = '', data = {}) {
        // Encode data for POST submission
        var params = new URLSearchParams();
        for(i in data){
           params.append(i,data[i]);
        }
        // Send form data to server for procesing and await for the response
        const response = await fetch(url, {
            method: 'POST', 
            mode: 'cors', 
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', 
            referrer: 'no-referrer',
            body: params
        });
        // Return fetch response
        return response;
    }
}

// Initial function that starts when message is received from parent thread
onmessage = async function(formContentObject) {
    // Create result object from received data
    let result = JSON.parse( (JSON.stringify(formContentObject.data) ) ); 
    // Start processing from data
    let sendMsgResult = await sendFbMsg(result);
}