<?php
use Abraham\TwitterOAuth\TwitterOAuth;

// Get temporary credentials.
$this->request_token = $this->twitterConnection->oauth("oauth/request_token", [ 
	'oauth_callback' => APP_URL . 'tokenHandling/twitterHandler.php'
]);
		
// If last connection failed don't display authorization link
switch ( $this->twitterConnection->getLastHttpCode() ) {
    case 200:
	   // Build authorize URL and redirect user to Twitter
	   $this->url = 'https://api.twitter.com/oauth/authenticate?oauth_token=' . $this->request_token['oauth_token'];
	   header('Location: ' . $this->url); 
	break;
	default:
		// Show notification if something went wrong
		echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}