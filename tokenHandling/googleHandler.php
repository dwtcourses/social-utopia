<?php
// Handler for Twitter user auth token
session_start();



// Load composer required files
require_once "../vendor/autoload.php";

$client = new Google_Client();
$client->setAuthConfig('../_inc/_private/client_secret.json');
$client->addScope('https://www.googleapis.com/auth/business.manage');
$client->setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/socialMediaApp/tokenHandling/googleHandler.php');

$client->authenticate($_GET['code']);
//$_SESSION['google_token'] = $client->getAccessToken();

// Get current managed page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
// Store token information into user session
$_SESSION['userInformation']->$selectedFacebookPage->google = new stdClass();
$_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token = $client->getAccessToken();

// Redirect user
header('Location: https://dev.interactiveutopia.com/socialMediaApp?googleLoggedIn=true');

// Debug Stuff
//echo '<pre>';
    //print_r($_REQUEST);
    //print_r($access_token);
   // echo'<pre>';print_r($_SESSION);echo'</pre>';
//echo '<pre>';