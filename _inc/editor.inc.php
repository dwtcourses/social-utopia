<?php
// Message Editor / Composer View
?>
			<div class="container-fluid">
				<div class="row">
 					<div class="col-md-3">
					<h2>Accounts:</h3>
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
					require_once('_inc/twitter.inc.php');
?>
 					</div>
  					<div class="col-md-9">
						<h2>Let's Send A Message</h2>
							<form class="formStyle" id="form">
<?php
					if ( isset($_GET['manageSelectedFacebookPage']) ) {
?>
								<input type="hidden" name="facebookPageId" id="facebookPageId" value="<?= $fbPageId; ?>">
								<input type="hidden" name="facebookToken" id="facebookToken" value="<?= $_SESSION['userInformation']->$selectedFacebookPage->facebook->pageToken; ?>">
<?php
					} else {
?>								<input type="hidden" name="facebookPageId" id="facebookPageId" value="false">
								<input type="hidden" name="facebookToken" id="facebookToken" value="false">
<?php
					}
								
					if ( isset ( $_SESSION['twitterLoggedIn'] ) ) {					
?>
								<input type="hidden" name="twitterToken" id="twitterToken" value="twitter">
<?php						
					} else {
?>
								<input type="hidden" name="twitterToken" id="twitterToken" value="false">
<?php	
					}
?>
								<div class="form-group">
									<label for="postMessage">Message:</label>
									<textarea id="postMessage" name="postMessage" class="form-control"></textarea><br>
								</div>
								<div class="form-group">
									<label for="linkURL">Link URL:</label>
									<input type="url" id="linkURL" name="linkURL" class="form-control" /><br>
								</div>
								<div class="form-group">
									<label for="postImage">Post Image:</label>
									<input type="file" class="form-control" id="postImage" name="postImage">
								</div>
								<div id="preview"><img src="https://img.icons8.com/wired/2x/preview-pane.png" /></div><br>
								<button type="submit" id="sendMessageBtn" name="sendMessageBtn" class="btn btn-primary" value="Send Message" <?php if( !isset( $_SESSION['userInformation'] ) ) echo 'disabled'; ?>>Send Message</button>
							</form>
							<div id="err"></div>
 					</div>
				</div>
				<script src="_js/formGlobal.js"></script>
			</div>
