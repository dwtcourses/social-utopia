<?php
// Application handler
// Send message and photo are started via Send Message Form submit button called by jQuery (AJAX)

// Require loader file
require_once('_inc/loader.inc.php');

$_fb = new facebookCustom();
/* Build TwitterOAuth object with client credentials. */
$_twitter = new twitterCustom();
/* Build LinkedIn custom class */
$_linkedIn = new linkedInCustom();
// Build Google API Class
$_google = new googleCustom();

// Set variables
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$targetNetworks = json_decode($_POST['targetNetwork'] ?? '');
//print_r($_POST);
// Form values
$facebookPageId = $_POST['facebookPageId'] ?? '';
$facebookToken = $_POST['facebookToken'] ?? '';
$twitterToken = $_POST['twitterToken'] ?? '';
$linkedInRequest = $_POST['linkedInToken'] ?? '';
$linkedInRequest = $_POST['googleToken'] ?? '';
$postMessage = $_POST['postMessage'] ?? '';
$linkURL = $_POST['linkURL'] ?? '';

// If photo use photo upload function
	if(  isset($_POST['imgData']) ) {
		require_once( '_inc/photoUploader.inc.php' );
	} else {
		if ( isset( $targetNetworks->facebookToken ) ) {
            // Check to see if temp image is stored on server
            if ( isset ( $_SESSION['imgTempUrl'] ) ){
                $_fb->uploadPhoto( $postMessage, $facebookToken, $facebookPageId, $_SESSION['imgTempUrl'] );
            } else {
                if ( $postMessage != '') $_fb->sendMessage( $postMessage, $facebookToken, $facebookPageId, $linkURL );
                    else echo 'Facebook: Cannot send empty message... | ';
            }
        }
	// Twitter Section
		if ( isset( $targetNetworks->twitterToken ) ) {
            // Check to see if temp image is stored on server
			if ( isset ( $_SESSION['imgTempUrl'] ) ){
                $_twitter->uploadTwitterPicture($_SESSION['imgTempUrl'], $postMessage);
            } else {
                if ( $linkURL != '') { $postMessage = $postMessage . ' at ' . $linkURL; }
                if ( $postMessage != '') $_twitter->sendMessage( $postMessage );
                    else echo 'Twitter: Cannot send empty message... | ';
            }
		}
    // LinkedIn Section
        if ( isset( $targetNetworks->linkedInToken ) ) {
            $selectedCompanyTarget = str_replace("urn:li:organization:", "", $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget);
            if ( $postMessage != '') {
                if ( isset ( $_SESSION['imgTempUrl'] ) ){
                    // Sent message with photo
                    $_linkedIn->uploadPhoto( $_SESSION['imgTempLocalUrl'], $postMessage ); 
                } else {
                    $_linkedIn->sendMessage( $postMessage ); 
                }
            } else echo 'Linked In: Cannot send empty message... | ';

        }
    // Google My Business API Section
        if ( isset( $targetNetworks->googleToken ) ) {
            if ( $postMessage != '') {
                if ( isset ( $_SESSION['imgTempUrl'] ) ){
                    $_google->sendPhotoMessage( $postMessage, $linkURL );
                } else $_google->sendMessage( $postMessage );
            } else echo 'Google My Business: Cannot send empty message...';
        } 
	}

//echo 'test complete';