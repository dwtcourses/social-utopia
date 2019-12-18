// JavaScript Document
// This file will handle social media network timelines

async function getFacebookTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/facebook.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        let facebookTimelineDiv = document.createElement( 'div' );
        facebookTimelineDiv.innerHTML += text;
        timelinesContainerDiv.appendChild( facebookTimelineDiv );
    });
}
getFacebookTimeline();

async function getGoogleTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/google.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        let googleTimelineDiv = document.createElement( 'div' );
        googleTimelineDiv.innerHTML += text;
        timelinesContainerDiv.appendChild( googleTimelineDiv );
    });
}
getGoogleTimeline();

async function getTwitterTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/twitter.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        let timelineDiv = document.createElement( 'div' );
        timelineDiv.innerHTML += text;
        timelinesContainerDiv.appendChild( timelineDiv );
    });
}
getTwitterTimeline();

async function getLinkedInTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/linkedin.timeline.php');
    let timelinesContainerDiv = document.getElementById('timelinesContainer');
    
    response.text().then(function (text) {
        // do something with the text response
        let timelineDiv = document.createElement( 'div' );
        timelineDiv.innerHTML += text;
        timelinesContainerDiv.appendChild( timelineDiv );
    });
}
getLinkedInTimeline();