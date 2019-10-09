<?php
use Abraham\TwitterOAuth\TwitterOAuth;

$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['twitterLoggedInUserToken']['oauth_token'], $_SESSION['twitterLoggedInUserToken']['oauth_token_secret']);

$tweetStatus = $this->twitterConnection->post("statuses/update", ["status" => $postMessage]);
echo ' | Twitter Message Sent';