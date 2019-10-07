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

//$_fb->sendMessage( $_POST['message'], $_POST['facebokPageToken'], $_POST['facebokPageId'] );
echo ' test';