<h2>Accounts</h3>
<?php
					if ( isset($_GET['manageSelectedFacebookPage']) || isset($_SESSION['lastFbPageToManage']) ) {
						if ( isset($_GET['manageSelectedFacebookPage']) ) {
							$selectedFacebookPage = $_GET['manageSelectedFacebookPage'];
							$_SESSION['lastFbPageToManage'] = $_SESSION['fbPageInformation']->$selectedFacebookPage->id;
						}
						if ( isset($_SESSION['lastFbPageToManage']) ) 
							$selectedFacebookPage = $_SESSION['lastFbPageToManage'];
						
						
						$fbPageId =  $_SESSION['userInformation']->$selectedFacebookPage->facebook->id;
?>
						<h3>Facebook Page</h3>
						<p><?= $_SESSION['userInformation']->$selectedFacebookPage->facebook->pageName; ?></p>
<?php
					}
					else {
?>
						<h3>Facebook</h3>
						<p>Select page to manage</p>
<?php
					}
					// Include Twitter Management Code
					require_once('./_inc/twitter.inc.php');
?>