<?php

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

if (!isset($_SESSION['userInformation']->$selectedFacebookPage->twitter)) {
?>
	<span class="account_network_content">
		<span class="account_network">Twitter</span>
		<a href="twitterRedirect.php"><input type="button" id="loginTwitter" class="btn btn-primary" value="Login | Twitter " /></a>
	</span>
<?php
} else print_r($_twitter->getUserBasicInformation());
