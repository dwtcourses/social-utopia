<?php
use Abraham\TwitterOAuth\TwitterOAuth;

// Check to see if user is logged in already
if ( !isset($_SESSION['twitterLoggedIn']) ) {
	// Check response to make user user authorized the access
	if ( !isset( $_GET ['denied'] ) ) {
    // Create new Twitter API Connection with new user credentials
	$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_GET['oauth_token'], $_GET['oauth_verifier']);

	// Retrieve final user access token
	$this->access_token = $_SESSION['twitterLoggedInUserToken'] = $this->twitterConnection->oauth("oauth/access_token", [ "oauth_verifier" => $_GET['oauth_verifier'] ]);

	// Set Twitter Logged In for user to true
	$_SESSION['twitterLoggedIn'] = true;
        
	$managingUserPageId = $_SESSION['lastFbPageToManage'];
	$_SESSION['userInformation']->$managingUserPageId->twitter = new stdClass();
	$_SESSION['userInformation']->$managingUserPageId->twitter->token = $this->access_token;
				
	// Redirect User To App
	header('Location: https://dev.interactiveutopia.com/socialMediaApp?twitterLoggedIn=true');
    } else {
	// If user did not authorize access to his account then throw error
    echo '<h1>Authorization Error</h1>';
	exit();
    }
}