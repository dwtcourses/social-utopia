<?php
// ------------------------------------------------------------------------------
// Upload photo to LinkedIn Server
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

$requestMessage = new stdClass;
$requestMessage->registerUploadRequest = new stdClass;
    $requestMessage->registerUploadRequest->owner = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget;
    $requestMessage->registerUploadRequest->recipes = array();
    $requestMessage->registerUploadRequest->recipes[] = 'urn:li:digitalmediaRecipe:feedshare-image';
    $requestMessage->registerUploadRequest->serviceRelationships = array();
    $requestMessage->registerUploadRequest->serviceRelationships[] = (object) ['identifier' => 'urn:li:userGeneratedContent', 'relationshipType' => 'OWNER'];
        //eval(class { 'identifier' : 'urn:li:userGeneratedContent', 'relationshipType' = 'OWNER'})
        //$requestMessage->registerUploadRequest->serviceRelationships[]->identifier = 'urn:li:userGeneratedContent';
        //$requestMessage->registerUploadRequest->serviceRelationships[]->relationshipType = 'OWNER';
    $data_string = json_encode($requestMessage);

    $linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
    $linkedInURL = "https://api.linkedin.com/v2/assets?action=registerUpload&oauth2_access_token=" . $linkedIn_user_token;

// Send request via POST to https://api.linkedin.com/v2/assets?action=registerUpload
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $linkedInURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );                                                                                                             
    $server_output = curl_exec($ch);
    curl_close ($ch);

// Handle response
$serverDecodedResponse = json_decode($server_output);
$tmpVar = 'com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest';
$uploadrlTmp = $serverDecodedResponse->value->uploadMechanism->$tmpVar->uploadUrl;
$uploadImgTmpUrn = $serverDecodedResponse->value->asset;

// Debug
//echo '<pre>';
//    print_r($serverDecodedResponse);
//    //echo  '<br/><br/>' .$uploadrlTmp . '<br/><br/>';
//echo '</pre>';

// ------------------------------------------------------------------------------

// Image upload sample request
// curl -i --upload-file /Users/peter/Desktop/superneatimage.png --header "Authorization: Bearer redacted" 'https://api.linkedin.com/mediaUpload/C5522AQGTYER3k3ByHQ/feedshare-uploadedImage/0?ca=vector_feedshare&cn=uploads&m=AQJbrN86Zm265gAAAWemyz2pxPSgONtBiZdchrgG872QltnfYjnMdb2j3A&app=1953784&sync=0&v=beta&ut=2H-IhpbfXrRow1'

$linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
    $linkedInURL = $uploadrlTmp . "&oauth2_access_token=" . $linkedIn_user_token;

$body = fopen($imgUrl, 'r');
$client = new GuzzleHttp\Client();
$res = $client->request('POST', $linkedInURL, [
    'body' => $body
]);

// Debug
//echo '<pre>';
    //print_r($res);
//echo '</pre>';

// ------------------------------------------------------------------------------

// Send message with picture

$test_message = new stdClass;
    $test_message->owner = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget;
    $test_message->text = new stdClass;
        $test_message->text->text = $postMessage;
    $test_message->subject = 'Test subject';
    $test_message->distribution = new stdClass;
        $test_message->distribution->linkedInDistributionTarget = new stdClass;
    $test_message->content = new stdClass;
    $test_message->content->contentEntities = [ (object) [ 'entity' => $uploadImgTmpUrn ] ];
    $test_message->content->title = 'Testing title';
    $test_message->content->landingPageUrl = 'https://gctermitecontrol.com';
    $test_message->content->shareMediaCategory = 'IMAGE';
$data_string = json_encode($test_message);

$linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
$linkedInURL = "https://api.linkedin.com/v2/shares/?oauth2_access_token=" . $linkedIn_user_token;

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $linkedInURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );                                                                                                             
    $server_output_imgMsgPosted = curl_exec($ch);
    curl_close ($ch);
    
// Debug   
/*echo '<pre>';
    //print_r($data_string);
echo '</pre>';
echo '<pre>';
    print_r($server_output_imgMsgPosted);
echo '</pre>';*/

// Send response back to main thread
echo '<br/>LinkedIn Image Post Sent<br/>';