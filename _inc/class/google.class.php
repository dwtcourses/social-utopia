<?php
// Google API Custom Class

class googleCustom {
    
    public $selectedFacebookPage;
    
    function __construct(){
		$this->selectedFacebookPage = $_SESSION['lastFbPageToManage'];
	}
    
    function sendMessage( $postMessage = '' ) {
            require $_SERVER['DOCUMENT_ROOT'] . '_inc/controller/google/sendMessage.google.php';
    }
}