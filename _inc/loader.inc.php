<?php
// Error Reporting On
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

// Start session in server
	session_start();

// Load global application variables
    require ('_inc/_private/auth.tokens.php');

// Load composer required files
	require_once "vendor/autoload.php";

// Load MySQL Class
    require_once('_inc/class/mysql.class.php');
    $_sql = new mysql();

// Load Facebook Custom Class
	require_once('_inc/class/facebookCustom.class.php');
	// Start Facebook Custom Class
	$_fb = new facebookCustom();

// Load Twitter Custom Class
	require_once ('_inc/class/twitterCustom.class.php');
	/* Start Twitter Class */
	$_twitter = new twitterCustom();