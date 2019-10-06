<?php
// Require loader file
	require_once('_inc/loader.inc.php');

// Load Page Header
	require_once ('_inc/header.inc.php');

// Check for Logged In User
	if ( !isset( $_SESSION['user'] ) ){
        // If not logged in, then load home page content
		require_once('_inc/home.inc.php');
	} else {
        // If user is logged in then continue
        
        // Check to see if user is new or returning
        if ( $_sql->checkIt( 'select tokens from iu_users where facebookId = "' . $_fb->getUserInformation()['id'] . '"' ) == false ) {
			// If new user, then display sign up page
            require_once('_inc/setUpUser.inc.php');
		} else {
            // If user is returning continue
            
            // Check to see if user already has selected a page to manage
			if ( isset($_GET['manageSelectedFacebookPage']) || isset($_SESSION['lastFbPageToManage']) ) {
				// If yes, include post editor / composer
				require_once('_inc/editor.inc.php');
			}
			// Include Facebook Management Code
			require_once('_inc/facebook.inc.php');
            
            $facebookUserId =  $_fb->getUserInformation()['id'];
            $userInfo = serialize( $_SESSION['userInformation'] );
            try {
            $query = "UPDATE iu_users SET tokens = :userTokens WHERE facebookId = :facebookId";
            $queryRequest = $_sql->status->prepare( $query );
            $queryRequest->bindParam(':userTokens', $userInfo, PDO::PARAM_STR );
            $queryRequest->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
            $queryRequest->execute();
  //              echo '<pre>';
//					print_r( $queryRequest->errorInfo() );
//				echo '</pre>';
            //echo $facebookUserId . ' | ' . $userInfo . ' | <br/>';
  //          $queryRequest->debugDumpParams();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            $query = "SELECT * FROM iu_users where facebookId = :facebookId";
            $queryRequest2 = $_sql->status->prepare( $query );
            $queryRequest2->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
            $queryRequest2->execute();

            
				echo '<pre>';
					print_r( $queryRequest2->fetchAll() );
                    print_r( $_SESSION );
				echo '</pre>';
		}
    // End if user is logged in
	}

// Load Page Footer
	require_once ('_inc/footer.inc.php');