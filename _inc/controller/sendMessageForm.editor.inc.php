<h2>Let's Send A Message!</h2>
<form class="formStyle" id="form">
	<div class="row">
		<div class="col">
			<div class="socialMediaNetworkToggles">
				<label for="facebookToggle">Facebook</label>
				<input type="checkbox" id="facebookToggle" name="facebookToggle" <?php if (isset($_SESSION['userInformation']->$selectedFacebookPage)) echo 'checked';
																					else echo 'disabled'; ?> />

				<label for="twitterToggle">Twitter</label>
				<input type="checkbox" id="twitterToggle" name="twitterToggle" <?php if (isset($_SESSION['userInformation']->$selectedFacebookPage->twitter)) echo 'checked';
																				else echo 'disabled'; ?> />

				<label for="linkedInToggle">LinkedIn</label>
				<input type="checkbox" id="linkedInToggle" name="linkedInToggle" <?php if (isset($_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget)) echo 'checked';
																					else echo 'disabled'; ?> />

				<label for="googleToggle">Google My Business</label>
				<input type="checkbox" id="googleToggle" name="googleToggle" <?php if (isset($_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation)) echo 'checked';
																				else echo 'disabled'; ?> />

			</div>
			<?php
			// Clear temp image info
			$_SESSION['erasing'] = true;
			//echo '<pre>'; print_r($_SESSION); echo '</pre>';
			sleep(1);
			unset($_SESSION['imgTempUrl']);
			unset($_SESSION['imgTempName']);
			unset($_SESSION['imgTempLocalUrl']);
			unset($_SESSION['erasing']);

			// Facebook API
			if (isset($_SESSION['userInformation']->$selectedFacebookPage)) {
			?>
				<input type="hidden" name="facebookPageId" id="facebookPageId" value="<?= $fbPageId; ?>">
				<input type="hidden" name="facebookToken" id="facebookToken" value="<?= $_SESSION['userInformation']->$selectedFacebookPage->pageToken; ?>">
			<?php
			}
			// Twitter API
			if (isset($_SESSION['userInformation']->$selectedFacebookPage->twitter)) {
			?>
				<input type="hidden" name="twitterToken" id="twitterToken" value="true">
			<?php
			}
			// LinkedIn API              
			if (isset($_SESSION['userInformation']->$selectedFacebookPage->linkedIn->companyTarget)) {
			?>
				<input type="hidden" name="linkedInToken" id="linkedInToken" value="true">
			<?php
			}
			// Google API
			if (isset($_SESSION['userInformation']->$selectedFacebookPage->google->locationInformation)) {
			?>
				<input type="hidden" name="googleToken" id="googleToken" value="true">
			<?php
			}
			?>
			<div class="form-group" id="msgEditorForm">
				<label for="postMessage">Message:</label>
				<textarea id="postMessage" name="postMessage" class="form-control" onkeyup="countChar()"></textarea><br>
				<div id="charNum"></div><br />
			</div>
			<div class="form-group">
				<label for="linkURL">Link URL:</label>
				<input type="url" id="linkURL" name="linkURL" class="form-control" onkeyup="countChar()" /><br>
			</div>
			<div class="form-group">
				<label for="postImage">Post Image:</label>
				<input type="file" class="form-control" id="postImage" name="postImage" accept="image/*" onChange="uploadImage(this)">
			</div>
			<button type="submit" id="sendMessageBtn" name="sendMessageBtn" class="btn btn-primary" value="Send Message" <?php if (!isset($_SESSION['userInformation'])) echo 'disabled'; ?>>Send Message</button>
		</div>
		<div class="col">
			<div id="preview"><img src="images/preview-panel.png" id="previewImageHolder" /></div><br>
			<div id="responseViewDiv"></div><br>
		</div>
	</div>



</form>
<div id="err"></div>