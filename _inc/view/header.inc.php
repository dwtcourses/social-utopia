<?php
// Social Media Application Header
?>
<html>
	<head>
		<?php 
        // Load required javascript and css files
            require("js.inc.php");
            require("css.inc.php");
        // Check to see if user just completed sign up
		if (isset ( $_GET['userSignUp'] )) {
?>
		<script>
			alert("Thank you for signing up, you can now use the app!");
		</script>
<?php
		}
?>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand">GC Social Utopia</a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="/socialMediaApp">App</a></li>
						<li><a href="http://webdevelopmentguy.com">Web Development Guy</a></li>
						<li><a href = "https://dev.interactiveutopia.com/socialMediaApp/logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav>
		</header>
		
			<div class="jumbotron">
				<h1>GC Social Utopia</h1>
			</div>
			<div class="container">