<?php
// Create user acount in database
?>
<div class="container">
	<h2><?= $_fb->getUserInformation()['name']; ?> Please Sign Up</h2>
	<p>Hello! You need to create an account in order to use this app.</p>
	<p>By clicking below you understand that your information will be stored, it will be used to better improve this app.</p>
	<a href="signUp.php"><input type = "button" id = "signUp" class = "btn btn-primary"  value = "Sign Up"/></a>
</div>