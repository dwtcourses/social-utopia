<?php
// This file will handle Google API Redirect Requests

// Require loader file
require_once('_inc/loader.inc.php');

// Get current managed page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

// Get Google token creation and expiration date to check for validation
$tokenCreatedOn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['created'];
$tokenExpiresIn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['expires_in'];
$expirationDateS = $tokenCreatedOn + $tokenExpiresIn;

// Get current date
$date = new DateTime();

// Create a new expiration date based on the current date and time
$expirationDate = new DateTime();
$expirationDate->setTimestamp($expirationDateS);

// Check current date and time spam to make sure token has not expired
if ($expirationDate <= $date) unset($_SESSION['userInformation']->$selectedFacebookPage->google);

// Log In Redirect
// Check to see is there is a Google token stored in the user session, if not then run code below
if (!isset($_SESSION['userInformation']->$selectedFacebookPage->google)) {
    // Initiate Google Client API Class
    $client = new Google_Client();
    // Provide authentication token
    $client->setAuthConfig('./_inc/_private/client_secret.json');
    // Request required API scope
    $client->addScope('https://www.googleapis.com/auth/business.manage');
    // Provide return redirect url
    $client->setRedirectUri(APP_URL . 'tokenHandling/googleHandler.php');
    // offline access will give you both an access and refresh token so that
    // your app can refresh the access token without user interaction.
    $client->setAccessType('offline');
    // Using "consent" ensures that your application always receives a refresh token.
    // If you are not using offline access, you can omit this.
    //$client->setApprovalPrompt("consent");
    $client->setIncludeGrantedScopes(true);   // incremental auth

    // Create Google log in url
    $auth_url = $client->createAuthUrl();
    // Redirect user to Google OAuth log in page
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

} else if (isset($_GET['locationInfo'])) {
    // Check to see if there if a location has been selected by the user, if yes then run code below
    
    $locationNum = $_GET['locationInfo'];
    $googleMyBusLocations = $_SESSION['temp']['locationsInfo'];

    foreach ($googleMyBusLocations as $googleMyBusLocation) {
        $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation = new stdClass();
        $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation = $googleMyBusLocations->locations[$locationNum];
        // Debug
        //print_r($_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation);
    }
    // Redirect user to Google OAuth log in page
    header('Location: ' . APP_URL);
}
