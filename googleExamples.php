<?php
// Load composer required files
	require_once "./vendor/autoload.php";
session_start();
if ( !isset( $_SESSION['access_token'] ) ) {
    $client = new Google_Client();
    $client->setAuthConfig('./_inc/_private/client_secret.json');
    $client->addScope('https://www.googleapis.com/auth/business.manage');
    $client->setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/socialMediaApp/tokenHandling/googleHandler.php');
    // offline access will give you both an access and refresh token so that
    // your app can refresh the access token without user interaction.
    $client->setAccessType('offline');
    // Using "consent" ensures that your application always receives a refresh token.
    // If you are not using offline access, you can omit this.
    //$client->setApprovalPrompt("consent");
    $client->setIncludeGrantedScopes(true);   // incremental auth

    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    //https://assets.pcmag.com/media/images/549560-apple-imac-2019-27-inch.jpg?width=640&height=471
    //https://mybusiness.googleapis.com/v4/accounts/{accountId}/locations/{locationId}/localPosts
    //https://mybusiness.googleapis.com/v4/accounts?oauth_token=ya29.Il-pB-MMukgo-cywcixtuev-S8tuVsx30LekKlhfTBwdZEjLeVp0oC2AdlPFboAptGrJyeTUbEpZemB0171GOZaiQhnuC1MwzYlrWiDlF7Vo_zq-9nxXs0YJhFSVnkP9TA
    $submitJson = '{
          "languageCode": "en-US",
          "summary": "Order your Thanksgiving turkeys now!!",
          "callToAction": {
            "actionType": "ORDER",
            "url": "http://google.com/order_turkeys_here",
          },
          "media": [
            {
              "mediaFormat": "PHOTO",
              "sourceUrl": "https://www.google.com/real-turkey-photo.jpg",
            }
          ],
        }';
    
    $url = 'https://mybusiness.googleapis.com/v4/accounts/113973717102153909319/locations/00817159802626613707/localPosts';
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,'idtoken=');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
    echo $server_output;
    print_r($_SESSION);
    //echo $_SESSION['access_token']['access_token'];
}