<?php
use Abraham\TwitterOAuth\TwitterOAuth;

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$oath_token = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token'];
$oath_token_secret = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token_secret'];

$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oath_token, $oath_token_secret);

$tweetStatus = $this->twitterConnection->post("statuses/update", ["status" => $postMessage]);
echo ' | Twitter Message Sent';