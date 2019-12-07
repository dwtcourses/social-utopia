<?php
// Google API Custom Class

class googleCustom {
    
    public $selectedFacebookPage;
    
    function __construct(){
		if (!isset($_SESSION['lastFbPageToManage'])) {
            if (isset($_SESSION['userInformation']->lastManagedPgId)) $_SESSION['lastFbPageToManage'] = $_SESSION['userInformation']->lastManagedPgId;
            else $_SESSION['lastFbPageToManage'] = '';
        }
	}
    
    function sendMessage( $postMessage = '' ) {
            require $_SERVER['DOCUMENT_ROOT'] . '_inc/controller/google/sendMessage.google.php';
    }
}