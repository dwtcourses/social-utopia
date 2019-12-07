<?php
// Google API Log In View

// Check to see if user is logged in
// Get current managed page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
// Store token information into user session

    
if ( !isset ( $_SESSION['userInformation']->$selectedFacebookPage->google ) ) {
?>
<h4>Google My Business</h4>
<p><a href="googleRedirect.php"><input type="button" id="loginGoogle" class="btn btn-primary"  value = "Login | Google "/></a></p>

<?php
} else if ( !isset ( $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation ) ){
    echo '<h3>Google</h3>';
    echo '<p><a href="logout.php?logOutGoogle=' . $selectedFacebookPage . '">Log Out</a></p>';
    // If user is logged in then have him select a company & location to manage
    $url = 'https://mybusiness.googleapis.com/v4/accounts/113973717102153909319/locations';
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, false);
	$access_token = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['access_token'];
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
    
    // Store locations information
    $googleMyBusLocations = json_decode($server_output);
    $_SESSION['temp']['locationsInfo'] = $googleMyBusLocations;
    
    echo '<h5>Select Location To Manage</h5>';
    $i = 0;
    foreach ( $googleMyBusLocations as $googleMyBusLocation ) {
        foreach ( $googleMyBusLocation as $googleMyBusLocationInformation ) {
            echo '<p><a href="googleRedirect.php?locationInfo=' . $i . '">' . $googleMyBusLocationInformation->locationName . '</a></p>';
            $i++;  
        }
    }
    
    // Debug
    //echo'<pre>';
	//	print_r (json_decode($server_output));
	//echo'</pre>';
} else if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation ) ){
    echo '<h4>Google</h4>';
    echo '<p><a href="logout.php?logOutGoogle=' . $selectedFacebookPage . '">Log Out</a></p>';
    echo $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation->locationName;
}