<?php
use Abraham\TwitterOAuth\TwitterOAuth;

$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['twitterLoggedInUserToken']['oauth_token'], $_SESSION['twitterLoggedInUserToken']['oauth_token_secret']);
			
$twitterUploadedPhoto = $this->twitterConnection->upload( "media/upload", array(
    'media' => $postImagePath
));
			
$mediaID = $twitterUploadedPhoto->media_id_string;
//build the data needed to send to twitter, including the tweet and the image id
$picPostParams = array(
    'status' => $postMessage,
	'media_ids' => $mediaID
);
//post the tweet
$tweetStatus = $this->twitterConnection->post("statuses/update", $picPostParams);
echo ' | Twitter Picture Sent';
//echo $mediaID;
//print_r ($tweetStatus);