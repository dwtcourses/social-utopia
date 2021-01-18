<?php
// Send message to location
/*
$submitJson = '{
	"languageCode": "en",
	"topicType": "LOCAL_POST_TOPIC_TYPE_UNSPECIFIED",
	"summary": "' . $postMessage . '",
	"callToAction": {
		"actionType": "LEARN_MORE",
		"url": "http://google.com/order_turkeys_here"
	},
	"media": [{
		"mediaFormat": "PHOTO",
		"sourceUrl": "https://blog.psprint.com/sites/default/files/2012/10/Paint-A-Clever-Turkey-for-Thanksgiving-Day-Google-Chrome_2012-10-31_13-36-12.png"
	}]
}';
*/

// Generate Json code to provide to google
$submitJson = '{
	"languageCode": "en-US",
	"topicType": "STANDARD",
	"summary": "' . $postMessage . '"
}';

// Debug
//echo $submitJson;

// Set connection variables and provide access token
$selectedFacebookPage = $_SESSION['userInformation']->lastManagedPgId;
$locationUrl = $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation->name;
$url = 'https://mybusiness.googleapis.com/v4/' . $locationUrl . '/localPosts';
$access_token = $_SESSION['userInformation']->$selectedFacebookPage->google->google_user_token['access_token'];

// CURL Connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $submitJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);

$decoded_server_output = json_decode($server_output);
if ($decoded_server_output->state == 'LIVE') {
?>
	<p>Text Message Sent to Google My Business (<a href="<?php echo $decoded_server_output->searchUrl; ?>">See Post</a>)</p>
<?php
}

// Debugging
// echo '<pre>';
// print_r($decoded_server_output);
// echo '</pre>';
