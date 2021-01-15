<?php
use Abraham\TwitterOAuth\TwitterOAuth;

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$oath_token = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token'];
$oath_token_secret = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token_secret'];
// Create new Twitter API Connection with final user credentials
$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oath_token, $oath_token_secret);
		
// Get user content
$this->content = $this->twitterConnection->get("account/verify_credentials");
//echo '<pre>';
//	print_r ( $this->content );
//echo '<pre>';
echo '<span class="account_network_content">
        <span class="account_network">Twitter</span>';

echo '' . $this->content->name . ' | ';
echo '  <a href="logout.php?logOutTwitter=' . $selectedFacebookPage . '">Log Out</a>
    </span>';
//$statues = $this->twitterConnection->post("statuses/update", ["status" => "hello world"]);