<?php
// Require loader file
require_once('_inc/loader.inc.php');

$_fb = new facebookCustom();
/* Build TwitterOAuth object with client credentials. */
$_twitter = new twitterCustom();

// Set variables
	$facebookPageId = $_POST['facebookPageId'] ?? '';
	$facebookToken = $_POST['facebookToken'] ?? '';
	$twitterToken = $_POST['twitterToken'] ?? '';
	$postMessage = $_POST['postMessage'] ?? '';
	$linkURL = $_POST['linkURL'] ?? '';

// If photo use photo upload function
	if(  $_FILES['postImage']['tmp_name'] != '' ) {
		require_once( '_inc/photoUploader.inc.php' );
	} else {
		$_fb->sendMessage( $postMessage, $facebookToken, $facebookPageId, $linkURL );
	// Twitter Section
		if ( isset ( $_SESSION['twitterLoggedIn'] ) ) {
			if ( $linkURL != '') { $postMessage = $postMessage . ' at ' . $linkURL; }
			$_twitter->sendMessage( $postMessage );
		}
	}

//echo 'test complete';