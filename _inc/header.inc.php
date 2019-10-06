<?php
// Social Media Application Header
?>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
		
		<script src="_js/global.js"></script>
		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link href="styles/global.css" rel="stylesheet" />		
<?php
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