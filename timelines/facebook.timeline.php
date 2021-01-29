<?php
// Facebook tieline
// Require loader file
require_once('../_inc/loader.inc.php');

// Include linkify() function
// It allows to convert any links in strings into urls with proper <a> tags
require_once '../_inc/functions/linkify.inc.php';


// Start Facebook Custom Class
$_fb = new facebookCustom();
// Current facebook page
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
?>
<h3>Facebook</h3>
<?php
/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $_fb->fb->get(
    '/' . $selectedFacebookPage . '/feed', // Facebook Page to Retrieve Timeline
    '' . $_SESSION['userInformation']->$selectedFacebookPage->pageToken . '' // Authorization token
  );
} catch (Facebook\Exceptions\FacebookResponseException $e) { // Catch graph error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) { // Catch SDK error
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

// Store retrieved data
$graphEdgeResponse = $response->getGraphEdge();
/* handle the result */
// Loop to get posts from received data
foreach ($graphEdgeResponse as $resObjectResponse) {
  // Second loop to be able to see proteted items
  echo '<p>';
  foreach ($resObjectResponse as $key => $value) {
    // Handle post content
    switch ($key) {
      case 'created_time':
        //print_r($value);
        //$postedOnTimeString = date_format($value, "F j, Y, g:i a");
        $postedOnTimeString = date_format($value, "U");
        $postedOnTime = new DateTime();
        $postedOnTime->setTimestamp($postedOnTimeString);
        $postedOnTime->setTimezone(new DateTimeZone('America/Los_Angeles'));
        $postedOnTimeString = $postedOnTime->format("F j, Y, g:i a");
        echo '<span class="facebookTimelineSpanPostedDate">On ' . $postedOnTimeString . '</span><br/>';
        break;
      case 'id':
        //print_r($value);
        break;
      default:
        echo '<span class="facebookTimelineSpanPostedText">' . linkify($value) . '</span>';
    }
    //print_r($resObjectResponse[$key]);
  }
  echo '</p>';
  //echo '<pre>'; print_r($resObjectResponse); echo '</pre>';
  //exit();
}
