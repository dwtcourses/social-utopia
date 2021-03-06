<?php
// Error Reporting On
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

// Start session in server
	session_start();

if ( $_SERVER['DOCUMENT_ROOT'] == '/var/www/vhosts/interactiveutopia.com/subdomains/dev/httpdocs')
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'] . '/socialMediaApp/';
else $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'] . '/';

// Load global application variables
    require ( $_SERVER['DOCUMENT_ROOT'] . '_inc/_private/auth.tokens.php');

// Load composer required files
	require_once $_SERVER['DOCUMENT_ROOT'] . "vendor/autoload.php";

// Load MySQL Class
    require_once($_SERVER['DOCUMENT_ROOT'] . '_inc/class/mysql.class.php');
    $_sql = new mysql();

// Load Facebook Custom Class
	require_once($_SERVER['DOCUMENT_ROOT'] . '_inc/class/facebookCustom.class.php');

// Load Twitter Custom Class
	require_once ($_SERVER['DOCUMENT_ROOT'] . '_inc/class/twitterCustom.class.php');

// Load LinkedIn Custom Class
	require_once ($_SERVER['DOCUMENT_ROOT'] . '_inc/class/linkedIn.class.php');

// Load Google API Custom Class
	require_once ($_SERVER['DOCUMENT_ROOT'] . '_inc/class/google.class.php');