<?php
use Abraham\TwitterOAuth\TwitterOAuth;
class twitterCustom {
	
	public $twitterConnection;

	function __construct(){
		
		$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		//$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	}
	
    // Send a message with a picture to twitter
	function uploadTwitterPicture( $postImagePath, $postMessage ){
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/twitter/uploadTwitterPicture.twitt.inc.php');
	}
	
    // Send a message to twitter account
	function sendMessage( $postMessage ){
        include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/twitter/sendMessage.twitt.inc.php');
	}
    
    // Get Twitter user basic info
	function getUserBasicInformation (){
        include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/twitter/getUserBasicInformation.twitt.inc.php');
	}
	
    // Retrieve Twitter user access tocken at Log In
	function retrieveUserAccessToken () {
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/twitter/retrieveUserAccessToken.twitt.inc.php');
	}
	
    // Intial Twitter user log in request
	function requestUserLogIn(){
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/twitter/requestUserLogIn.twitt.inc.php');
	}
}