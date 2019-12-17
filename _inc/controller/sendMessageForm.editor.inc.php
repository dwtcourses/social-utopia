<h2>Let's Send A Message!</h2>
							<form class="formStyle" id="form">
<?php
// Facebook API
					if ( isset( $_SESSION['userInformation']->$selectedFacebookPage ) ) {
?>
								<input type="hidden" name="facebookPageId" id="facebookPageId" value="<?= $fbPageId; ?>">
								<input type="hidden" name="facebookToken" id="facebookToken" value="<?= $_SESSION['userInformation']->$selectedFacebookPage->pageToken; ?>">
<?php
					}
// Twitter API
					if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->twitter ) ) {					
?>
								<input type="hidden" name="twitterToken" id="twitterToken" value="true">
<?php						
					}
// LinkedIn API              
					if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget ) ) {					
?>
								<input type="hidden" name="linkedInToken" id="linkedInToken" value="true">
<?php						
					}
// Google API
                    if ( isset ( $_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation ) ) {					
?>
								<input type="hidden" name="googleToken" id="googleToken" value="true">
<?php						
					}
?>
								<div class="form-group" id="msgEditorForm">
									<label for="postMessage">Message:</label>
									<textarea id="postMessage" name="postMessage" class="form-control" onkeyup="countChar(this)"></textarea><br>
                                    <div id="charNum"></div><br/>
								</div>
								<div class="form-group">
									<label for="linkURL">Link URL:</label>
									<input type="url" id="linkURL" name="linkURL" class="form-control" /><br>
								</div>
								<div class="form-group">
									<label for="postImage">Post Image:</label>
									<input type="file" class="form-control" id="postImage" name="postImage" accept="image/*" onChange="uploadImage(this)">
								</div>
								<div id="preview"><img src="https://img.icons8.com/wired/2x/preview-pane.png" id="previewImageHolder" /></div><br>
								<div id="responseViewDiv"></div><br>
								<button type="submit" id="sendMessageBtn" name="sendMessageBtn" class="btn btn-primary" value="Send Message" <?php if( !isset( $_SESSION['userInformation'] ) ) echo 'disabled'; ?>>Send Message</button>
							</form>
							<div id="err"></div>