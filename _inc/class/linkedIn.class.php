<?php

class linkedInCustom {
	
	public $linkedInConnection;

	function __construct(){
		
	}
	
    function sendMessage( $postMessage ) {
        require $_SERVER['DOCUMENT_ROOT'] . '_inc/controller/linkedIn/sendMessage.linkedIn.php';
    }
    
    function uploadPhoto( $imgUrl, $postMessage ) {
        require $_SERVER['DOCUMENT_ROOT'] . '_inc/controller/linkedIn/uploadPhoto.linkedIn.php';
    }

}