<?php
		// Initiate log in helper to obtain response
		$helper = $this->fb->getRedirectLoginHelper();
		try {
            // Obtain Facebook user access token    
		      $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
		  // Logged in!
          // Store Facebook access token in server session  
		  $_SESSION['facebook_access_token'] = (string) $accessToken;
		  $_SESSION['user'] = true;
          // Redirect user back to app
		  header("Location: https://dev.interactiveutopia.com/socialMediaApp");
          // Kill application after user redirect
		  die();
		} elseif ($helper->getError()) {
		  // The user denied the request
          header("Location: https://dev.interactiveutopia.com/socialMediaApp");
		  exit;
		}