<h3>Account Manager</h3>
<?php
// Contains left sidebar, account manager and navigator

					if ( isset($_GET['manageSelectedFacebookPage']) || isset($_SESSION['lastFbPageToManage']) ) {
						if ( isset($_GET['manageSelectedFacebookPage']) ) {
							$selectedFacebookPage = $_GET['manageSelectedFacebookPage'];
							$_SESSION['lastFbPageToManage'] = $selectedFacebookPage;
						}
						if ( isset($_SESSION['lastFbPageToManage']) ) 
							$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
						
						$fbPageId =  $selectedFacebookPage;
?>
						<h4>Facebook Page</h4>
						<p><?= $_SESSION['userInformation']->$selectedFacebookPage->pageName; ?></p>
                        
<?php
					$_SESSION['userInformation']->lastManagedPgId = $_SESSION['lastFbPageToManage'];
                    }
					else {
?>
						<h3>Facebook</h3>
						<p>Select page to manage</p>
<?php
					}
					// Include Twitter Management Code
					require_once('./_inc/view/twitter.inc.php');

                    // Include LinkedIn Management Code
					require_once('./_inc/view/logIn.linkedIn.php');

                    // Include Google My Business Management Code
					require_once('./_inc/view/login.google.inc.php');
?>