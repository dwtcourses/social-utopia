<?php
// Social Utopia
// User starts logging in with their FC account
// After logging in he can select a FB page to manage
// He will have option to log in to Twitter account via editor controller as well

// Require loader file
	require_once('_inc/loader.inc.php');
// Start Facebook Custom Class
	$_fb = new facebookCustom();
/* Start Twitter Class */
	$_twitter = new twitterCustom();

// Load Page Header
	require_once ('_inc/view/header.inc.php');

// Check for Logged In User
	if ( !isset( $_SESSION['user'] ) ){
        // If not logged in, then load home page content
		require_once('_inc/home.inc.php');
	} else {
        // If user is logged in then continue
        // Check to see if user is new or returning
        
        if ( $_sql->checkIt( 'select tokens from iu_users where facebookId = "' . $_fb->getUserInformation()['id'] . '"' ) == false ) {
			// If new user, then display sign up page
            require_once('_inc/setUpUser.inc.php');
		} else {
            // If user is returning continue
            // Check to see if user already has selected a page to manage
			if ( !empty( $_GET['manageSelectedFacebookPage']) || !empty($_SESSION['lastFbPageToManage']) ) {
                    // If yes, include post editor / composer
				    require_once('./_inc/view/editor.inc.php');
                    require_once('./_inc/view/timelines.inc.php');
			} else {
			     // Include Facebook Management Code
			     require_once('_inc/facebook.inc.php');
            }
		}
    // End if user is logged in
	}

// Load Page Footer
	require_once ('_inc/footer.inc.php');