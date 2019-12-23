<?php
// Load composer required files
require_once "../vendor/autoload.php";
session_start();
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
?>
    <div>
        <h3>Google My Business</h3>
<?php
$pgLocationInfo = $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation->name;
$requestUrl = 'https://mybusiness.googleapis.com/v4/' . $pgLocationInfo . '/localPosts';
$access_token = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['access_token'];
    
// Curl
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $requestUrl);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
    $serverReponseObject = json_decode($server_output);
    
    $localPostsArray = $serverReponseObject->localPosts;

foreach ($localPostsArray as $key => $value) {
    $localPostInfo = $localPostsArray[$key];
    echo '</p>';
    $postedOn = DateTime::createFromFormat("Y-m-d\TG:i:s.u\Z", $localPostInfo->createTime); //2019-12-18T05:00:44.523Z
        $postedOn->setTimezone(new DateTimeZone('America/Los_Angeles'));
        $postedOnTimeString = $postedOn->format( "F j, Y, g:i a" );
    echo '<span class="googleTimelineSpanPostedDate">On ' . $postedOnTimeString . '</span><br/>';
    echo '<span class="googleTimelineSpanPostedText">' . $localPostInfo->summary . '</span><br/>';
    echo '</p>';
    //echo '<pre>'; print_r ($localPostInfo); echo '</pre>';
}
?>
    </div>