<?php
// Google API Log In View

// Check to see if user is logged in
// Get current managed page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
// Store token information into user session

?>
<span class="account_network_content">
    <span class="account_network">Google My Business</span>
    <?php
    // If there is no google token stored in session then run code below
    if (!isset($_SESSION['userInformation']->$selectedFacebookPage->google)) {
    ?>
        <a href="googleRedirect.php"><input type="button" id="loginGoogle" class="btn btn-primary" value="Login | Google " /></a>
    <?php
        // If there is a google token stored on session, then make sure that there is a location selected, if there is not then run code below
    } else if (!isset($_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation)) {

        echo ' <a href="logout.php?logOutGoogle=' . $selectedFacebookPage . '">Log Out</a>';
        // If user is logged in then have him select a company & location to manage
        $url = 'https://mybusiness.googleapis.com/v4/accounts/113973717102153909319/locations';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        $access_token = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['access_token'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        // Store locations information
        $googleMyBusLocations = json_decode($server_output);
        $_SESSION['temp']['locationsInfo'] = $googleMyBusLocations;

        echo '<h5>Select Location To Manage</h5>';
        $i = 0;
        foreach ($googleMyBusLocations as $googleMyBusLocation) {
            foreach ($googleMyBusLocation as $googleMyBusLocationInformation) {
                echo '<p><a href="googleRedirect.php?locationInfo=' . $i . '">' . $googleMyBusLocationInformation->locationName . '</a></p>';
                $i++;
            }
        }
        // Debug
        //echo'<pre>';
        //	print_r (json_decode($server_output));
        //echo'</pre>';

        // If there is a location selected then run code below
    } else if (isset($_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation)) {

        $tokenCreatedOn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['created'];
        $tokenExpiresIn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['expires_in'];
        $expirationDateS = $tokenCreatedOn + $tokenExpiresIn;

        // Current date
        $date = new DateTime();

        // Expiration date
        $expirationDate = new DateTime();
        $expirationDate->setTimestamp($expirationDateS);

        if ($expirationDate <= $date) {
            echo 'Token has expired';
            echo ' <a href="googleRedirect.php">Refresh Token</a> |';
            echo ' <a href="logout.php?logOutGoogle=' . $selectedFacebookPage . '">Log Out</a>';
        } else {
            echo $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation->locationName;
            echo ' | <a href="logout.php?logOutGoogle=' . $selectedFacebookPage . '">Log Out</a> ';
        }
    }
    ?>
</span>