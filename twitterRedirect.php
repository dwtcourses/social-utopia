<?php
// Error Reporting On
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session in server
session_start();

// Load composer required files
require_once "vendor/autoload.php";

// Load Twitter Custom Class
require_once ('_inc/class/twitterCustom.class.php');

/* Build TwitterOAuth object with client credentials. */
$_twitter = new twitterCustom();
$connection = $_twitter->requestUserLogIn();