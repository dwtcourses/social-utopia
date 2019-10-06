<?php
// Get Facebook pages that user can manage
$_fb->requestUserManagePagesList();

// Get user Facebook information and ID
$facebookUserId =  $_fb->getUserInformation()['id'];
$userInfo = serialize( $_SESSION['userInformation'] );

// Database connection #1
        try {
           // Update user token in database
            $query = "UPDATE iu_users SET tokens = :userTokens WHERE facebookId = :facebookId";
            $queryRequest = $_sql->status->prepare( $query );
            $queryRequest->bindParam(':userTokens', $userInfo, PDO::PARAM_STR );
            $queryRequest->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
            $queryRequest->execute();
                
            // Debuggin
                //echo '<pre>';
    				//print_r( $queryRequest->errorInfo() );
                //echo '</pre>';
                //echo $facebookUserId . ' | ' . $userInfo . ' | <br/>';
                $queryRequest->debugDumpParams();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
// Database connection #2
try {
    // Get user information from database
    $query = "SELECT * FROM iu_users where facebookId = :facebookId";
    $queryRequest2 = $_sql->status->prepare( $query );
    $queryRequest2->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
    $queryRequest2->execute();
    //echo '<pre>';
        //print_r( $queryRequest2->fetchAll() );
        //print_r( $_SESSION );
    //echo '</pre>';
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}