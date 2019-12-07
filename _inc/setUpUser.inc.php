<?php
// Create user acount in database
?>
<div class="container">
	<h2>Welcome <?= $_fb->getUserInformation()['name']; ?>!</h2>
    <p>Hello! We noticed this is your first time visiting us, please sign up to get started. You need to create an custom environment with Social Utopia in order to take advantage of the features it has to offer.</p>
	<p>By clicking the sign up button below, you understand that your information (name, email, connected account information, etc) will be stored on our serves, it will be used to better improve and test this application.</p>
	<p style="text-align: center"><a href="signUp.php"><input type = "button" id = "signUp" class = "btn btn-primary btn-lg"  value = "Sign Up and Create Environment"/></a></p>
</div>