<?php
// Include linkify() function
// It allows to convert any links in strings into urls with proper <a> tags
include_once '../_inc/functions/linkify.inc.php';


// Twitter timeline
// This file will be async requested from the main app via a Worker
// Require loader file
include_once('../_inc/loader.inc.php');

use Abraham\TwitterOAuth\TwitterOAuth;

// Get currently selected facebook page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

// Get search query
if (!empty($_GET['search_hashtag'])) $search_hashtag = '#' . $_GET['search_hashtag'];
else $search_hashtag = '#interactiveUtopia';

// Check to see if user is logged into Twitter under the selected facebook page
if (isset($_SESSION['userInformation']->$selectedFacebookPage->twitter)) {
    // If user is authenticated with twitter then:
    // Get authentication credentials
    $oath_token = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token'];
    $oath_token_secret = $_SESSION['userInformation']->$selectedFacebookPage->twitter['oauth_token_secret'];
    // Start a new connection to Twittter API
    $twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oath_token, $oath_token_secret);
    // Request user timeline from Twitter via a GET requests routed via the Abraham Twitter API
    $statuses = $twitterConnection->get(
        "search/tweets",
        array(
            'q' => $search_hashtag,
            'count' => 15,
        )
    );
    $statuses = $statuses->statuses;

    //Start printing timeline conent
?>
    <script>
        const search_hashtag = () => {
            let hashtag = document.getElementById('hashtag').value;
            window.location.href = "https://social.interactiveutopia.com/timelines/twitter.hastags.php?search_hashtag=" + hashtag;
        }
    </script>
    <p>Recent tweets with <?php echo $search_hashtag; ?></p>
    <form>
        <label for="hashtag">Hashtag:</label>
        <input type="text" name="hashtag" id="hashtag">
        <input type="button" value="Search" id="hashtag_search_btn" onclick="search_hashtag()">
    </form>
<?php

    // Get search hashtag
    if (empty($_GET['search_hashtag']))
        exit();

    
    // Loop through received timeline statuses to print each individual one
    foreach ($statuses as $key => $value) {
        echo '<p>';
        // Format posted on date infomration
        $postedOn = DateTime::createFromFormat("D M d G:i:s e Y", $statuses[$key]->created_at);
        $postedOn->setTimezone(new DateTimeZone('America/Los_Angeles'));
        $postedOnTimeString = $postedOn->format("F j, Y, g:i a");

        // Print status posted date and time (formated)
        echo '<span class="twitterTimelineSpanPostedDate">On ' . $postedOnTimeString . '</span><br/>';
        echo '<span class="twitterTimelineSpanPostedBy">By ' .
            $statuses[$key]->user->name .
            ' (<a href="https://twitter.com/' . $statuses[$key]->user->screen_name . '" target="_blank">@' . $statuses[$key]->user->screen_name . '</a>)' .
            ' | <a href="' . $statuses[$key]->user->url . '" target="_blank">Website</a>'
            . '</span><br/>';

        // Print status text summary
        echo '<span class="twitterTimelineSpanPostedText">' . linkify($statuses[$key]->text) . '</span><br/>';
        echo '</p>';
        /*echo '<pre>';
        print_r($statuses[$key]);
    echo '</pre>';*/
    }

    // echo '<pre>';
    // print_r($statuses);
    // echo '</pre>';


} else echo 'null'; // if user is not authenticated then return null
