<?php
// Home Page
// This is the user main welcome page.
// User is not yet logged in
?>
<div id="homeContent">
    <h2 class="homeh2">Open-Source Social Media Management Environment</h2>
    <h3>Handle all of your social media posting and management in one place!</h3>
    <div id="facebookLogInDiv">
        <i class="fab fa-facebook"></i>
        <p>To start please log in using Facebook</p>
        <?php
        // Insert Facebook Log In Button
        $_fb->requestUserLogInFromFacebook();
        ?>
    </div>
</div>