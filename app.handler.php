<?php
// Error Reporting On
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

// Start session in server
	session_start();

// Load composer required files
	require_once "vendor/autoload.php";

// Load Facebook Custom Class
	require_once('_inc/class/facebookCustom.class.php');
	// Start Facebook Custom Class
	$_fb = new facebookCustom();

// Load Twitter Custom Class
	require_once ('_inc/class/twitterCustom.class.php');
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