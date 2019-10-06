<?php
use Abraham\TwitterOAuth\TwitterOAuth;
class twitterCustom {
	
	public $twitterConnection;
	
	function __construct(){
		define('CONSUMER_KEY', 'Vkp5s2AZbwrPunCGW0JA7Uk8D');
		define('CONSUMER_SECRET', 'NH5YH2LugwEnrnJIIAZcFQru6L3uqBxWUW15VcIdDtII7hsTzb');
		define('ACCESS_TOKEN', '188578770-SvwESKtyRDSZqSXVhBezGWtq13c3hLaikpGUGEC3');
		define('ACCESS_TOKEN_SECRET', 'QboEU3KQaydbFUDAfeRHU2O8u87keuOff54i94rDzipAY');
		$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		//$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	}
	
	function uploadTwitterPicture( $postImagePath, $postMessage ){
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
	}
	
	function sendMessage( $postMessage ){
			$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['twitterLoggedInUserToken']['oauth_token'], $_SESSION['twitterLoggedInUserToken']['oauth_token_secret']);
		
			$tweetStatus = $this->twitterConnection->post("statuses/update", ["status" => $postMessage]);
			echo ' | Twitter Message Sent';
	}
	function getUserBasicInformation (){
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
	}
	
	function retrieveUserAccessToken () {
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
	}
	
	function requestUserLogIn(){
		// Get temporary credentials.
		$this->request_token = $this->twitterConnection->oauth("oauth/request_token", [ 
			'oauth_callback' => 'https://dev.interactiveutopia.com/socialMediaApp/tokenHandling/twitterHandler.php'
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
	}
}