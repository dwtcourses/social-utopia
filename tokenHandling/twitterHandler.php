<?php
// Handler for Twitter user auth token

// Require loader file
require_once('../_inc/loader.inc.php');

/* Build TwitterOAuth object with client credentials. */
$_twitter = new twitterCustom();
$_twitter->retrieveUserAccessToken();