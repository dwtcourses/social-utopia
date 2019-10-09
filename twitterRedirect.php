<?php
// Handler file for Twitter class
// Handles initial log in auth and redirect

// Require loader file
require_once('_inc/loader.inc.php');

/* Build TwitterOAuth object with client credentials. */
$_twitter = new twitterCustom();
$connection = $_twitter->requestUserLogIn();