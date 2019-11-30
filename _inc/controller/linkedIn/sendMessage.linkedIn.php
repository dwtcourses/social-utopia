<?php
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
$test_message = new stdClass;
    $test_message->owner = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget;
    //$test_message->subject = urlencode("Subject Test 1");
    $test_message->text = new stdClass;
        $test_message->text->text = $postMessage;
    $test_message->distribution = new stdClass;
        $test_message->distribution->linkedInDistributionTarget = new stdClass;
        $test_message->distribution->linkedInDistributionTarget->visibleToGuest = true;
            
    $linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
    $linkedInURL = "https://api.linkedin.com/v2/shares/?oauth2_access_token=" . $linkedIn_user_token;
    $data_string = json_encode($test_message);                                                                                   
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $linkedInURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );                                                                                                             
    $server_output4 = curl_exec($ch);
    curl_close ($ch);
    
    echo ' | LinkedIn Message Sent';
   // $user_data = json_decode($server_output4);   
//echo '<pre>';
//    print_r($user_data);
//echo '</pre>';