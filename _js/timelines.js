// JavaScript Document
// This file will handle social media network timelines

async function afterStyles(){
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    var timelineNodes = timelinesContainerDiv.childNodes;
    //console.log('networks: ' + timelineNodes.length);
    var i;
    for (i = 0; i < timelineNodes.length; i++) {
        timelineNodes[i].classList.add('col-sm-6');
    }
    //console.log(timelineNodes);
}

async function getFacebookTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/facebook.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    if (document.getElementById('facebookTimelineDiv')){
        document.getElementById('facebookTimelineDiv').remove();
        console.log('old facebook removed');
    }
    
    response.text().then((text) => {
        if (text == 'null') { return false; }
        else {
            let facebookTimelineDiv = document.createElement( 'div' );
            facebookTimelineDiv.innerHTML += text;
            facebookTimelineDiv.setAttribute("id", "facebookTimelineDiv");
            timelinesContainerDiv.appendChild( facebookTimelineDiv );
            afterStyles();
            return true;
        }
    });
}

async function getGoogleTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/google.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        if (text == 'null') { return false; }
        else {
            if (document.getElementById('googleTimelineDiv')){
                document.getElementById('googleTimelineDiv').remove();
            }
            
            let googleTimelineDiv = document.createElement( 'div' );
            googleTimelineDiv.innerHTML += text;
            googleTimelineDiv.setAttribute("id", "googleTimelineDiv");
            timelinesContainerDiv.appendChild( googleTimelineDiv );
            afterStyles();
            return true;
        }
    });
}

async function getTwitterTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/twitter.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        if (text == 'null') { return false; }
        else {
            if (document.getElementById('twitterTimelineDiv')){
                document.getElementById('twitterTimelineDiv').remove();    
            }
            
            let timelineDiv = document.createElement( 'div' );
            timelineDiv.innerHTML += text;
            timelineDiv.setAttribute("id", "twitterTimelineDiv");
            timelinesContainerDiv.appendChild( timelineDiv );
            afterStyles();
            return true;
        }
    });
}


async function getLinkedInTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/linkedin.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        if (text == 'null') { return false; }
        else {
            if (document.getElementById('linkedInTimelineDiv')){
                    document.getElementById('linkedInTimelineDiv').remove();
            }
            
            let timelineDiv = document.createElement( 'div' );
            timelineDiv.innerHTML += text;
            timelineDiv.setAttribute("id", "linkedInTimelineDiv");
            timelinesContainerDiv.appendChild( timelineDiv );
            afterStyles();
            return true;
        }
    });
}

async function refreshTimelines(){ 
    let facebookResponse = await getFacebookTimeline();
    let googleResponse = await getGoogleTimeline();
    let twitterResponse = await getTwitterTimeline();
    let linkedInResponse = await getLinkedInTimeline();
    
    Promise.all([facebookResponse, googleResponse, twitterResponse, linkedInResponse]).then( () => { 
        console.log('all done');
    });
}

window.addEventListener('load', function () {
  refreshTimelines();
})