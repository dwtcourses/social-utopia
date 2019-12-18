<?php
// Twitter timeline
// Require loader file
	require_once('../_inc/loader.inc.php');
use Abraham\TwitterOAuth\TwitterOAuth;

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$oath_token = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token'];
$oath_token_secret = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token_secret'];

$twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oath_token, $oath_token_secret);
$statuses = $twitterConnection->get("statuses/user_timeline");

?>
    <div id="twitterTimelineDiv">
        <h3>Twitter</h3>
<?php
echo '<pre>';
    print_r($statuses);
echo '</pre>';
?>
    </div>