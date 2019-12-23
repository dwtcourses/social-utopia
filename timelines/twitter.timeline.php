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
        foreach ($statuses as $key => $value) {
            echo '<p>';
            //$postedOn = date();
            $postedOn = DateTime::createFromFormat("D M d G:i:s e Y", $statuses[$key]->created_at);
            $postedOn->setTimezone(new DateTimeZone('America/Los_Angeles'));
            //echo $postedOn . '<br/>';
            $postedOnTimeString = $postedOn->format( "F j, Y, g:i a" );
            echo '<span class="twitterTimelineSpanPostedDate">On ' . $postedOnTimeString . '</span><br/>';
            echo '<span class="twitterTimelineSpanPostedText">' . $statuses[$key]->text . '</span><br/>';
            echo '</p>';
            /*echo '<pre>';
                print_r($statuses[$key]);
            echo '</pre>';*/
        }

?>
    </div>