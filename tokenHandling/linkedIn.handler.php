<?php
// Handler for LinkedIn user auth token, this is the page that gets called after user authenticates at LinkedIn website

// Require loader file
require_once('../_inc/loader.inc.php');

if(isset($_GET['code'])){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://www.linkedin.com/oauth/v2/accessToken");
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&code=".$_GET['code']."&redirect_uri=" . LINKEDIN_LOGIN_REDIRECT_URI . "&client_id=" . LINKEDIN_CLIENT_ID . "&client_secret=" . LINKEDIN_CLIENT_SECRET);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
    
    // Save obtained credentials into user session
    $selectedFacebookPage = $_SESSION['lastFbPageToManage'];

    $_SESSION['userInformation']->$selectedFacebookPage->linkedIn = new stdClass();
    $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->code = $_GET['code'];
    $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->state = $_GET['state'];
    $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token = json_decode($server_output);
    //echo '<pre>';
//        print_r( $server_output );
//    echo '</pre>';
    
    header('Location: https://dev.interactiveutopia.com/socialMediaApp?linkedInLoggedIn=true');
    
} else {
    // If user did not authorize access to his account then throw error
    echo '<h1>Authorization Error</h1>';
    echo '<pre>';
        print_r( $_REQUEST );
    echo '</pre>';
	exit();
}