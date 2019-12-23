<?php
use Abraham\TwitterOAuth\TwitterOAuth;
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$oath_token = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token'];
$oath_token_secret = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token_secret'];

$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oath_token, $oath_token_secret);
			
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
print_r ($tweetStatus);
echo $postImagePath;