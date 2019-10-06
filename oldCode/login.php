<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "vendor/autoload.php";

require_once('_inc/class/facebookCustom.class.php');

session_start();

$_fb = new facebookCustom();

$fb = $_fb->fb;

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('https://dev.interactiveutopia.com/socialMediaApp/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';