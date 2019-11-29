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

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

// Set variables
	$facebookPageId = $_POST['facebookPageId'] ?? '';
	$facebookToken = $_POST['facebookToken'] ?? '';
	$twitterToken = $_POST['twitterToken'] ?? '';
    $linkedInRequest = $_POST['linkedInToken'] ?? '';
	$postMessage = $_POST['postMessage'] ?? '';
	$linkURL = $_POST['linkURL'] ?? '';

// If photo use photo upload function
	if(  $_FILES['postImage']['tmp_name'] != '' ) {
		require_once( '_inc/photoUploader.inc.php' );
	} else {
		if ( $postMessage != '') $_fb->sendMessage( $postMessage, $facebookToken, $facebookPageId, $linkURL );
                else echo 'Cannot send empty message...';
	// Twitter Section
		if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->twitter ) ) {
			if ( $linkURL != '') { $postMessage = $postMessage . ' at ' . $linkURL; }
			if ( $postMessage != '') $_twitter->sendMessage( $postMessage );
                else echo 'Cannot send empty message...';
		}
    // LinkedIn Section
        if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget ) ) {
            $selectedCompanyTarget = str_replace("urn:li:organization:", "", $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget);
            
            if ( $postMessage != '') $_linkedIn->sendMessage( $postMessage );
                else echo 'Cannot send empty message...';

        }
	}

//echo 'test complete';