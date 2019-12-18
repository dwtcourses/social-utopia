<?php
// Facebook tieline
// Require loader file
	require_once('../_inc/loader.inc.php');
// Start Facebook Custom Class
	$_fb = new facebookCustom();
// Current facebook page
    $selectedFacebookPage = $_SESSION['lastFbPageToManage'];
?>
    <div>
        <h3>Facebook</h3>
<?php
/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $_fb->fb->get(
    '/' . $selectedFacebookPage . '/feed',
    '' . $_SESSION['userInformation']->$selectedFacebookPage->pageToken . ''
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphEdgeResponse = $response->getGraphEdge();
/* handle the result */
        echo '<pre>';
        foreach ($graphEdgeResponse as $resObjectResponse) {
            print_r($resObjectResponse);
        }
        echo '</pre>';
?>
    </div>