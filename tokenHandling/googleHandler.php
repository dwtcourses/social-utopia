<?php
// Handler for Twitter user auth token
// Require loader file
require_once('../_inc/loader.inc.php');
// Get current managed page
$selectedFacebookPage = $_SESSION['userInformation']->lastManagedPgId;

// Star new Google API Instance
$client = new Google_Client();
// Provide credentials
$client->setAuthConfig('../_inc/_private/client_secret.json');

// Check to see if there is no google account stored on page
// If there is not then log in user
if ( empty ($_SESSION['userInformation']->$selectedFacebookPage->google )){
    // Set scope required
    $client->addScope('https://www.googleapis.com/auth/business.manage');
    // Set redirect Url after user log in in Google server
    $client->setRedirectUri( APP_URL . 'tokenHandling/googleHandler.php');
    // Get autrizaton code from url
    $client->authenticate($_GET['code']);


    // Store token information into user session
    $_SESSION['userInformation']->$selectedFacebookPage->google = new stdClass();
    $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token = $client->getAccessToken();

    // Redirect user
    header('Location: ' . APP_URL . '?googleLoggedIn=true');
}

// Debug Stuff
//echo '<pre>';
    //print_r($_REQUEST);
    //print_r($access_token);
    echo'<pre>';print_r($_SESSION['userInformation']->$selectedFacebookPage);echo'</pre>';
//echo '<pre>';