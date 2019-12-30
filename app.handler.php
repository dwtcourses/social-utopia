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
$facebookPageId = strip_tags($_POST['facebookPageId']) ?? '';
$facebookToken = strip_tags($_POST['facebookToken']) ?? '';
$twitterToken = strip_tags($_POST['twitterToken']) ?? '';
$linkedInRequest = strip_tags($_POST['linkedInToken']) ?? '';
$linkedInRequest = strip_tags($_POST['googleToken']) ?? '';
$postMessage = strip_tags($_POST['postMessage']) ?? '';
$linkURL = strip_tags($_POST['linkURL']) ?? '';

if ( $linkURL != '') { $postMessage = $postMessage . ' at ' . $linkURL; }

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
                $_twitter->uploadTwitterPicture($_SESSION['imgTempName'], $postMessage);
            } else {
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
                $postMessageGoogle = addslashes($postMessage);
                if ( isset ( $_SESSION['imgTempUrl'] ) ){
                    $_google->sendPhotoMessage( $postMessageGoogle, $linkURL );
                } else $_google->sendMessage( $postMessageGoogle );
            } else echo 'Google My Business: Cannot send empty message...';
        } 
	}

//echo 'test complete';