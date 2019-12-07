<?php
// Request log in from user to obtain user token
		$helper = $this->fb->getRedirectLoginHelper();
		$permissions = ['email', 'manage_pages', 'publish_pages']; // optional
		$loginUrl = $helper->getLoginUrl('https://dev.interactiveutopia.com/socialMediaApp/login-callback.php', $permissions);
		
		// Print html for user to click to be redirected to Facebook
		echo '<a href="' . $loginUrl . '"><input type = "button" id = "loginFacebook" class = "btn btn-primary"  value = "Login with Facebook "/></a>';
		//echo '<li><a href="' . $loginUrl . '">Log in with Facebook!</a></li>';