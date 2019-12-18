<?php
// Load composer required files
require_once "../vendor/autoload.php";
session_start();
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
?>
    <div>
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

foreach ($localPostsArray as $k1 => $v) {
    $localPostInfo = $localPostsArray[$k1];
    //print_r ($localPostInfo);
    
    foreach ( $localPostInfo as $key => $value ) {
        switch ($key) {
            case 'callToAction':
                echo 'callToAction | ' . '<br/>';
                $callToActionObj = $localPostInfo->$key;
                foreach ( $callToActionObj as $key => $value ) {
                    echo ' ' . $key . ' : ' . $callToAction->$key . '<br/>';
                }
                break;
            case 'media':
                echo 'media | ' . '<br/>';
                $mediaObj = $localPostInfo->$key[0];
                foreach ( $mediaObj as $key => $value ) {
                    echo ' ' . $key . ' : ' . $mediaObj->$key . '<br/>';
                }
                break;
            default:
                echo $key . ' : ' . $localPostInfo->$key . '<br/>';
        }
    }
    echo '<br/><br/><br/>';
}
?>
    </div>