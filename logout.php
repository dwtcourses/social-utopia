<?php
// Error Reporting On
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session in server
session_start();

if ( isset( $_GET['logOutTwitter'] ) ){
    $selectedFacebookPage = $_GET['logOutTwitter'];
    unset( $_SESSION['userInformation']->$selectedFacebookPage->twitter );
    header("Location: https://dev.interactiveutopia.com/socialMediaApp");
    die();
} else {
    session_destroy();
    header("Location: https://dev.interactiveutopia.com/socialMediaApp");
    die();
}