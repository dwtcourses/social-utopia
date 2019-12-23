<?php
// Load composer required files
require_once "../vendor/autoload.php";
session_start();
$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
?>
    <div>
        <h3>Linked In</h3>
<?php
        //https://api.linkedin.com/v2/ugcPosts?q=authors&authors=List(url-encoded organization Urn)
        
//$selectedCompanyTarget = str_replace("urn:li:organization:", "", $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget);
$selectedCompanyTarget = urlencode($_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget);
        
        $ch = curl_init();
        $linkedIn_user_token = $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->token->access_token;
        $linkedInURL = "https://api.linkedin.com/v2/ugcPosts?q=authors&authors=List(" . $selectedCompanyTarget . ")&oauth2_access_token=" . $linkedIn_user_token;
        //echo $linkedInURL;

        curl_setopt($ch, CURLOPT_URL, $linkedInURL);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Authorization: Bearer' . $linkedIn_user_token,
            'X-Restli-Protocol-Version: 2.0.0'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        
        $responseObject = json_decode($server_output);
        $elements = $responseObject->elements;
        
        echo '<div class="linkedInTimeline">';
        
        // Loop inside each post
        foreach ($elements as $k => $v) {
            $specificContent = $elements[$k]->specificContent;
            $shareContentKey = 'com.linkedin.ugc.ShareContent'; 
            echo '<p>';
            
            // Get posted on date and turn into string
            $postedOnTime = new DateTime();
            $postedOnTime->setTimestamp( ($elements[$k]->firstPublishedAt / 1000 ) );
            $postedOnTimeString = $postedOnTime->format( "F j, Y, g:i a" ); 
            echo '<span class="linkedinTimelineSpanPostedDate">On ' . $postedOnTimeString . '</span><br/>';
            echo '<span class="linkedinTimelineSpanPostedText">' . $specificContent->$shareContentKey->shareCommentary->text . '</span><br/>';
            
            
            //echo '<pre>'; print_r($specificContent); echo '</pre>'; 
            //echo '<pre>'; print_r($elements[$k]); echo '</pre>'; 
            //exit();
        }
        
