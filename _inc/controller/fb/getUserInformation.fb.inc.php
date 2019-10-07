<?php

try {
    // Request information from Facebook
    $this->res = $this->fb->sendRequest('GET', '/me', array() , $_SESSION['facebook_access_token']);
                        
    // Convert response to object
	$this->resObject = $this->res->getGraphNode();
			
	//echo '<pre>';
	  // print_r($this->resObject);
	//echo '</pre>';
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '. $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '. $e->getMessage();
    exit;
}