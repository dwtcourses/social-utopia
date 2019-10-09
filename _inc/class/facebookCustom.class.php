<?php
class facebookCustom {
	
// Global Class Variables
	public $accessToken;
	public $fb;
	
// Set up facebookCustom Class
	function __construct(){
        // Start connection to Facebook Server
        $appID = APP_FB_ID;
        $appIDSecret = APP_FB_SECRET;
		$this->fb = new Facebook\Facebook([
		  'app_id' => $appID,
		  'app_secret' => $appIDSecret,
		  'default_graph_version' => 'v2.3',
		  // . . .
		  ]);
	}
// End __construct()

// Upload photo to Facebook Page
function uploadPhoto( $photoMessage, $pageToken, $pageId, $postImagePath ) {
    $photoMessage = $photoMessage; 
    $pageToken =  $pageToken; 
    $pageId = $pageId;
    $postImagePath = $postImagePath;
    include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/uploadPhoto.fb.inc.php');
}
	
// Send Message to Facebook Page
	function sendMessage($message, $pageToken, $pageId, $link){
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/sendMessage.fb.inc.php');
	}
// End sendMessage()
	
// Request user information
	function getUserInformation(){
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/getUserInformation.fb.inc.php');
        return $this->resObject;
	}
	
// Request list of Facebook pages that the user can manage
	function requestUserManagePagesList (){	
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/requestUserManagePagesList.fb.inc.php');
	}
// End requestUserManagePagesList();
	
// Start request for Facebook user login
	function requestUserLogInFromFacebook (){
		include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/requestUserLogInFromFacebook.fb.inc.php');
	}
// End requestUserLogInFromFacebook()
	
    // Log in Facebook user once he has authorized app
    function logInUserFromFacebook () {
        include ($_SERVER['DOCUMENT_ROOT'] . '_inc/controller/fb/logIn.fb.controller.php');
    }
}


