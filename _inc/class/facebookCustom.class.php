<?php

class facebookCustom {
	
// Global Class Variables
	public $accessToken;
	public $fb;
	
// Set up facebookCustom Class
	function __construct(){
        // Start connection to Facebook Server
		$this->fb = new Facebook\Facebook([
		  'app_id' => APP_FB_ID,
		  'app_secret' => APP_FB_SECRET,
		  'default_graph_version' => 'v2.3',
		  // . . .
		  ]);
	}
// End __construct()

// Upload photo to Facebook Page
function uploadPhoto( $photoMessage, $pageToken, $pageId, $postImagePath ) {
		  
	$data = [
		'message' => $photoMessage,
		'source' => $this->fb->fileToUpload( $postImagePath ),
	];
	try {
			// Upload to a user's profile. The photo will be in the
			// first album in the profile. You can also upload to
			// a specific album by using /ALBUM_ID as the path   			  
			$this->res = $this->fb->post('/' . $pageId . '/photos', $data, $pageToken);
			
			// Convert response to object
			$this->resObject = $this->res->getGraphNode();

			echo "Posted with id: " . $this->resObject['id'];

	} catch(FacebookRequestException $e) {

			echo "Exception occured, code: " . $e->getCode();
			echo " with message: " . $e->getMessage();

	}
}
	
// Send Message to Facebook Page
	function sendMessage($message, $pageToken, $pageId, $link){
		try {
            // Send Message
			$res = $this->fb->sendRequest('POST', '/' . $pageId . '/feed', ['message' => $message, 'link' => $link ], $pageToken, 'eTag', 'v2.2');
            // Print success message
			echo 'Message has been sent';
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: '. $e->getMessage();
				exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '. $e->getMessage();
				exit;
		}
	}
// End sendMessage()
	
// Request user information
	function getUserInformation(){
		try {
            // Request information from Facebook
			$this->res = $this->fb->sendRequest('GET', '/me', array() , $_SESSION['facebook_access_token']);
                        
            // Convert response to object
			$this->resObject = $this->res->getGraphNode();
			return $this->resObject;
			
			//echo '<pre>';
				//print_r($this->resObject);
			//echo '</pre>';
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: '. $e->getMessage();
				exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '. $e->getMessage();
				exit;
		}
	}
	
// Request list of Facebook pages that the user can manage
	function requestUserManagePagesList (){
		//GET /me/accounts
		try {
            // Request information from Facebook
			$this->res = $this->fb->sendRequest('GET', '/me/accounts', array() , $_SESSION['facebook_access_token']);
            
            // Use the information obtained from the request to obtain the page information like Page Name, Page Access Token and Page ID (Test)
            
            // Convert response to object
			$this->resObject = $this->res->getGraphEdge();
            
            // FOR DEBUG: Print all items in response object
				//print_r ($this->resObject);
			
            // Start loop to read response object
            $i = 0;
			$this->fbPageInformation = new stdClass();
            
            // Set up HTML - Table Format
    ?>	<div class="container-fluid">
					<h3>Select Page To Manage:</h3>
					<table class="table">
					<thead>
					<tr>
					  <th scope="col">Page Name</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
    <?php
			 $this->fbInformation = new stdClass();
			foreach ($this->resObject as $this->resObjectResponse) {
                // Print each page information on its own table row
				echo '<tr><td>' . $this->resObjectResponse['name'] . '</td><td><a href="?manageSelectedFacebookPage=' . $i . '">Use This Token</a></td></tr>';
				
                // Store row information on new object for further reference
				$this->fbPageInformation->$i = new stdClass();
				$this->fbPageInformation->$i->pageName = $this->resObjectResponse['name'];
				$this->fbPageInformation->$i->pageToken = $this->resObjectResponse['access_token'];
				$this->fbPageInformation->$i->id = $this->resObjectResponse['id'];
                
				$pgName = $this->resObjectResponse['id'];
                $this->fbInformation->$pgName = new stdClass();
				$this->fbInformation->$pgName->facebook = $this->fbPageInformation->$i;
				$i++;
			  }
				//echo '<pre>';
					//print_r( $this->fbInformation );
				//echo '</pre>';
				if( !isset( $_SESSION['userInformation'] ))
					$_SESSION['userInformation'] = $this->fbInformation;
				
//				echo '<pre>';
//					print_r($_SESSION['userInformation']);
//				echo '</pre>';
    ?>  
					</table>
				</div>
				
    <?php
			// Store completed response object information in server session
            $_SESSION['fbPageInformation'] = $this->fbPageInformation;
				//print_r ($_SESSION['fbPageInformation']);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: '. $e->getMessage();
				exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '. $e->getMessage();
				exit;
		}
		
		
	}
// End requestUserManagePagesList();
	
// Start request for Facebook user login
	function requestUserLogInFromFacebook (){
		// Request log in from user to obtain user token
		$helper = $this->fb->getRedirectLoginHelper();
		$permissions = ['email', 'manage_pages', 'publish_pages']; // optional
		$loginUrl = $helper->getLoginUrl('https://dev.interactiveutopia.com/socialMediaApp/login-callback.php', $permissions);
		
		// Print html for user to click to be redirected to Facebook
		echo '<a href="' . $loginUrl . '"><input type = "button" id = "loginFacebook" class = "btn btn-primary"  value = "Login | Facebook "/></a>';
		//echo '<li><a href="' . $loginUrl . '">Log in with Facebook!</a></li>';
	}
// End requestUserLogInFromFacebook()
	
// Log in Facebook user once he has authorized app
	function logInUserFromFacebook () {
		// Initiate log in helper to obtain response
		$helper = $this->fb->getRedirectLoginHelper();
		try {
            // Obtain Facebook user access token    
		      $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
		  // Logged in!
          // Store Facebook access token in server session  
		  $_SESSION['facebook_access_token'] = (string) $accessToken;
		  $_SESSION['user'] = true;
          // Redirect user back to app
		  header("Location: https://dev.interactiveutopia.com/socialMediaApp");
          // Kill application after user redirect
		  die();
		} elseif ($helper->getError()) {
		  // The user denied the request
          header("Location: https://dev.interactiveutopia.com/socialMediaApp");
		  exit;
		}
	}
// End logInUserFromFacebook()
}


