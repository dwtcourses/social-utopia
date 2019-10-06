<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once "vendor/autoload.php";

require_once('_inc/class/facebookCustom.class.php');

$_fb = new facebookCustom();
$_fb->logInUserFromFacebook();