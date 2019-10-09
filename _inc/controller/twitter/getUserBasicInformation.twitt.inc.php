<?php
use Abraham\TwitterOAuth\TwitterOAuth;

// Create new Twitter API Connection with final user credentials
$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['twitterLoggedInUserToken']['oauth_token'], $_SESSION['twitterLoggedInUserToken']['oauth_token_secret']);
		
// Get user content
$this->content = $this->twitterConnection->get("account/verify_credentials");
//echo '<pre>';
//	print_r ( $this->content );
//echo '<pre>';
echo "<h3>Twitter</h3>";
echo '<p>' . $this->content->name . '</p>';
//$statues = $this->twitterConnection->post("statuses/update", ["status" => "hello world"]);