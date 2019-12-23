<?php
// Require loader file
require_once('_inc/loader.inc.php');

if ( isset( $_GET['logOutTwitter'] ) ){
    $selectedFacebookPage = $_GET['logOutTwitter'];
    unset( $_SESSION['userInformation']->$selectedFacebookPage->twitter );
    header("Location: " . APP_URL);
    die();
} else if ( isset( $_GET['logOutLinkedIn'] ) ){
    $selectedFacebookPage = $_GET['logOutLinkedIn'];
    unset( $_SESSION['userInformation']->$selectedFacebookPage->linkedIn );
    header("Location: " . APP_URL);
    die();
} else if ( isset( $_GET['logOutGoogle'] ) ){
    $selectedFacebookPage = $_GET['logOutGoogle'];
    unset( $_SESSION['userInformation']->$selectedFacebookPage->google );
    header("Location: " . APP_URL);
    die();
} else {
    session_destroy();
    header("Location: " . APP_URL);
    die();
}