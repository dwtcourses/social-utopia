<?php
// Social Media Application Header
?>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Social Utopia - A social media management environment</title>
		<?php 
        // Load required javascript and css files
            require("js.inc.php");
            require("css.inc.php");
        // Check to see if user just completed sign up
		if (isset ( $_GET['userSignUp'] )) {  
        // If they have just signed up, then show alert 
?>
		<script>
			alert("Thank you for signing up, you can now use the app!");
		</script>
<?php
		}
?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-15528068-12"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-15528068-12');
        </script>


    </head>
	<body>
		<header>
			<?php 
                // Load navigation bar
                require("nav.inc.php"); 
            ?>
		</header>
			<div class="container-fluid p-0">