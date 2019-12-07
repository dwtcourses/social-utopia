<?php
// Main Component
// This is where the user will pick a facebook page to manage, as well it will record the information on the database and download/update the current session status


// Get user Facebook information and ID
$facebookUserId =  $_fb->getUserInformation()['id'];
if( !isset( $_SESSION['userInformation'] )) {
    // Get db state
    // Database connection #2
    try {
        // Get user information from database
        $query = "SELECT * FROM iu_users where facebookId = :facebookId";
        $queryRequest3 = $_sql->status->prepare( $query );
        $queryRequest3->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
        $queryRequest3->execute();
        $queryResults3 = $queryRequest3->fetch();
        //$_SESSION['userFacebookId'] = $queryResults3['facebookId'];
        $_SESSION['userInformation'] = unserialize ( $queryResults3['tokens'] );
        if (!isset($_SESSION['lastFbPageToManage'])) {
            if (isset($_SESSION['userInformation']->lastManagedPgId)) $_SESSION['lastFbPageToManage'] = $_SESSION['userInformation']->lastManagedPgId;
            else $_SESSION['lastFbPageToManage'] = '';
        }
        echo '<pre>';
            //print_r( $queryResults3 );
            //print_r( $_SESSION );
        echo '</pre>';
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
// Get Facebook pages that user can manage
$_fb->requestUserManagePagesList();

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
                //$queryRequest->debugDumpParams();
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
    $queryResults2 = $queryRequest2->fetch();
    $_SESSION['userFacebookId'] = $queryResults2['facebookId'];
    $_SESSION['userInformation'] = unserialize ( $queryResults2['tokens'] );
    
/*    echo '<pre>';
        //print_r( $queryResults2 );
        print_r( $_SESSION );
    echo '</pre>';*/
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}