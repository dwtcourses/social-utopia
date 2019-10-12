<?php

$selectedFacebookPage = $_SESSION['lastFbPageToManage'];

if ( !isset( $_SESSION['userInformation']->$selectedFacebookPage->twitter ) ) {
?>
	<h3>Twitter</h3>
	<p class=""><a href="twitterRedirect.php"><input type="button" id="loginTwitter" class="btn btn-primary"  value = "Login | Twitter "/></a></p>
<?php
}
else print_r ( $_twitter->getUserBasicInformation() );