// JavaScript Document
// AJAX Call to Send Message
$(document).ready(function (e) {
     $("#form").on('submit',(function(e) {
    // Prevent form from auto submitting and changing page
      e.preventDefault();
    // Clear response div
    $("#responseViewDiv").html('');
    // Get from data
    let receivedFormData = new FormData(this);
    // Check for browser support of web workers
    if (window.Worker) {
        // Set up information to send to worker
        // Create new form data object
        let formContentObject = new Object();
        // Crete new target network object
        let targetNetwork = new Object();
    
        // Loop thru received form data to generate object data
        for(var pair of receivedFormData.entries()) {
                let inputName = pair[0];
                switch (inputName) {
                    case 'facebookToken':
                        formContentObject[inputName] = pair[1];
                        targetNetwork['facebookToken'] = '0';
                        break;
                    case 'twitterToken':
                        formContentObject[inputName] = pair[1];
                        targetNetwork['twitterToken'] = '1';
                        break;
                    case 'linkedInToken':
                        formContentObject[inputName] = pair[1];
                        targetNetwork['linkedInToken'] = '2';
                        break;
                    case 'googleToken':
                        formContentObject[inputName] = pair[1];
                        targetNetwork['googleToken'] = '3';
                        break;
                    default:
                        formContentObject[inputName] = pair[1];
                }
        } // End for loop
        formContentObject['targetNetwork'] = JSON.stringify(targetNetwork);
        let responseDataHtml = '';
        for( var selectedNetwork in targetNetwork ){
            console.log('selected network #: ' + targetNetwork[selectedNetwork] );
            
            switch ( targetNetwork[selectedNetwork] ) {
                    case '0':
                    // Facebook
                        let fbWorker = new Worker('./_js/workers/formWorker.js');
                        formContentObject['targetNetwork'] = JSON.stringify( { facebookToken: 0 } );
                        // Post information to worker
                        fbWorker.postMessage( formContentObject );
                        // Get information from worker
                        fbWorker.onmessage = function(e) {
                            console.log('Facebook: Message received from worker: ' + e.data);
                            $("#responseViewDiv").append(e.data);
                            fbWorker.terminate();
                            console.log('Facebook: Worker terminated');
                            getFacebookTimeline();
                        }
                        break;
                    case '1':
                    // Twitter
                        let twitterWorker = new Worker('./_js/workers/formWorker.js');
                        formContentObject['targetNetwork'] = JSON.stringify( { twitterToken: 0 } );
                        // Post information to worker
                        twitterWorker.postMessage( formContentObject );
                        // Get information from worker
                        twitterWorker.onmessage = function(e) {
                            console.log(' Twitter: Message received from worker: ' + e.data);
                            $("#responseViewDiv").append(e.data);
                            twitterWorker.terminate();
                            console.log('Twitter: Worker terminated');
                            getTwitterTimeline();
                        }
                        break;
                    case '2':
                    // LinkedIn
                        let linkedInWorker = new Worker('./_js/workers/formWorker.js');
                        formContentObject['targetNetwork'] = JSON.stringify( { linkedInToken: 0 } );
                        // Post information to worker
                        linkedInWorker.postMessage( formContentObject );
                        // Get information from worker
                        linkedInWorker.onmessage = function(e) {
                            console.log(' LinkedIn: Message received from worker: ' + e.data);
                            $("#responseViewDiv").append(e.data);
                            linkedInWorker.terminate();
                            console.log('LinkedIn: Worker terminated');
                            getLinkedInTimeline();
                        }
                        break;
                    case '3':
                    // Google
                        let googleWorker = new Worker('./_js/workers/formWorker.js');
                        formContentObject['targetNetwork'] = JSON.stringify( { googleToken: 0 } );
                        // Post information to worker
                        googleWorker.postMessage( formContentObject );
                        // Get information from worker
                        googleWorker.onmessage = function(e) {
                            console.log(' Google: Message received from worker: ' + e.data);
                            $("#responseViewDiv").append(e.data);
                            googleWorker.terminate();
                            console.log('Google: Worker terminated');
                            getGoogleTimeline();
                        }
                        break;
                    default:
                        console.log('No network selected')
            }
            $("#form")[0].reset();
        }
    } // End if window.worker
 }));// End if form submit
});

async function uploadImage(imageData){
    console.log('Image upload started');
    const host = '.';
    var preview = document.getElementById('previewImageHolder');
    var file    = document.getElementById('postImage').files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", async function () {
        preview.src =  reader.result ;
        // Try to post information via postData() set below
        try {
            // Wait for information to be sent via postData() and store response
            const data = await postData(host + '/app.handler.php', { imgData : reader.result });
            // Process response to a text string
            data.text().then(function (text) {
              // send text response back to main thread
              console.log(text);
            });
        } catch (error) {
            // If there is an error, log it to the console
            console.error(error);
        }
    }, false);

    if (file) {
        reader.readAsDataURL(file);
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