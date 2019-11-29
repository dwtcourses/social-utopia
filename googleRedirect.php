<?php
// This file will handle Google API Redirect Requests

// Load composer required files
require_once "./vendor/autoload.php";
// Start session
session_start();

// Log In Redirect
if ( !isset( $_SESSION['access_token'] ) ) {
    // Initiate Google Client API Class
    $client = new Google_Client();
    // Provide authentication token
    $client->setAuthConfig('./_inc/_private/client_secret.json');
    // Request required API scope
    $client->addScope('https://www.googleapis.com/auth/business.manage');
    // Provide return redirect url
    $client->setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/socialMediaApp/tokenHandling/googleHandler.php');
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
}