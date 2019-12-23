<?php
// Load composer required files
require_once "../vendor/autoload.php";
// Start server session
session_start();
// Get current managed page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation ) ) {
    $tokenCreatedOn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['created'];
    $tokenExpiresIn = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['expires_in'];
    $expirationDateS = $tokenCreatedOn + $tokenExpiresIn;
    // Current date
    $date = new DateTime();
    // Expiration date
    $expirationDate = new DateTime();
    $expirationDate->setTimestamp($expirationDateS);
    
    // Check to see if token is valid
    if ( $expirationDate <= $date ) {
        echo 'null';
    } else {
$pgLocationInfo = $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation->name;
$requestUrl = 'https://mybusiness.googleapis.com/v4/' . $pgLocationInfo . '/localPosts';
$access_token = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['access_token'];
//echo '<pre>'; print_r($_SESSION['userInformation']->$selectedFacebookPage->google); echo '</pre>';
// Curl
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $requestUrl);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
        $serverReponseObject = json_decode($server_output);
        $emptyObject = new stdClass();
    //print_r(count($emptyObject));
    //print_r(count($serverReponseObject));
    //echo $server_output;
if ( !isset ($serverReponseObject->localPosts) ) { echo 'null'; }
else {
?>
        <h3>Google My Business</h3>
<?php
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
    }}
} else echo 'null';