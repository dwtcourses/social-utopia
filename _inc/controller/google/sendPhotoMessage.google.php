<?php
//echo 'sending google image post';

// Generate Json code to provide to google
if ($linkURL == '') {
  echo 'Google required a link url for this type of call to action post';
  exit();
} else {
  $submitJson = '{
      "languageCode": "en-US",
      "summary": "' . $postMessage . '",
      "callToAction": {
        "actionType": "LEARN_MORE",
        "url": "' . $linkURL . '",
      },
      "media": [
        {
          "mediaFormat": "PHOTO",
          "sourceUrl": "' . $_SESSION['imgTempUrl'] . '",
        }
      ],
    }';
}

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
  <p>Photo Message Sent to Google My Business (<a href="<?php echo $decoded_server_output->searchUrl; ?>">See Post</a>)</p>
<?php
}

// Debugging
// echo '<pre>';
// print_r($decoded_server_output);
// echo '</pre>';
