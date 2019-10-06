<?php
// Facebook Send Message View
?>
			<div class="container-fluid">
				<h2>Let's Send A Message</h2>
				<h3>Page: <?= $_SESSION['fbPageInformation']->$selectedFacebookPage->pageName; ?></h3>
				<div class="container">
					<form class="formStyle">
					<input type="hidden" id="facebokPageId" value="<?= $_SESSION['fbPageInformation']->$selectedFacebookPage->id; ?>">
					<input type="hidden" id="facebokPageToken" value="<?= $_SESSION['fbPageInformation']->$selectedFacebookPage->pageToken; ?>">
						Message: <textarea id="message" name="message"></textarea><br>
						Link URL: <input type="text" id="linkURL" name="linkURL" /><br>
						<button type="button" id="sendMessageBtn" name="sendMessageBtn" class="btn" value="Send Message">Send Message</button>
					</form>
				</div>
				<script src="_js/formGlobal.js"></script>
			</div>
