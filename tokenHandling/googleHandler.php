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
$_SESSION['access_token'] = $client->getAccessToken();

//echo '<pre>';
    //print_r($_REQUEST);
    //print_r($access_token);
    echo'<pre>';print_r($_SESSION);echo'</pre>';
//echo '<pre>';