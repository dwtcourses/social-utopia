<?php
// Home Page
// This is the user main welcome page.
// User is not yet logged in
?>
<div id="homeContent">
    <h2 class="homeh2">Social Media Management Done Right!</h2>
    <div id="facebookLogInDiv">
        <i class="fab fa-facebook"></i>
        <p>To start please log in using Facebook</p>
        <?php
        // Insert Facebook Log In Button
        $_fb->requestUserLogInFromFacebook();
        ?>
    </div>
    <p>Handle all of your social media posting and management in one place! And what is the best part of it? That it is free!</p>
    <ul>
        <li>Social Networks Supported:
            <ul>
                <li>Facebook</li>
                <li>Twitter</li>
                <li>LinkedIn</li>
                <li>Google My Business</li>
            </ul>
        </li>
        <li>How does it work?
            <ol>
                <li>Log in with Facebook</li>
                <li>Pick a page to manage</li>
                <li>Log in to other social networks</li>
                <li>Start posting!</li>
            </ol>
        </li>
    </ul>
</div>