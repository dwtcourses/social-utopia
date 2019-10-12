<?php
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

if ( !isset( $_SESSION['userInformation']->$selectedFacebookPage->linkedIn ) ) {
echo '<a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=' . LINKEDIN_CLIENT_ID . '&redirect_uri=' . LINKEDIN_LOGIN_REDIRECT_URI . '&state=fooobar&scope=' . LINKEDIN_SCOPE . '"><input type="button" id="loginTwitter" class="btn btn-primary"  value = "Login | LinkedIn "/></a>';
} else {
    $ch = curl_init();
    $linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
    $linkedInURL = "https://api.linkedin.com/v2/me?projection=(firstName,lastName)&oauth2_access_token=" . $linkedIn_user_token;
    
     curl_setopt($ch, CURLOPT_URL, $linkedInURL);
     curl_setopt($ch, CURLOPT_POST, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $server_output2 = curl_exec ($ch);
     curl_close ($ch);

     $user_data = json_decode($server_output2);
     
    //echo '<pre>';
//        echo $linkedInURL;
//    echo '</pre>';
//    echo '<pre>';
//        print_r($user_data);
//    echo '</pre>';
    echo '<p>' . $user_data->lastName->localized->en_US . '</p>';
}