// JavaScript Document
// This file will handle social media network timelines
async function getGoogleTimeline(){
    const response = await fetch('https://dev.interactiveutopia.com/socialMediaApp/timelines/google.timeline.php');
    response.text().then(function (text) {
        // do something with the text response
        let googleTimelineHtml = '<div id="googleTimelineContainer">';
        googleTimelineHtml += text;
        googleTimelineHtml += '</div>';
        
        document.getElementById('timelinesContainer').innerHTML = googleTimelineHtml;
    });
}

getGoogleTimeline();