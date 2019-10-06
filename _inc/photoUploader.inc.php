<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$postImagePath = 'uploads/'; // upload directory
if(!empty( $postMessage || $_FILES['postImage'] ) ) {
	$img = $_FILES['postImage']['name'];
	$tmp = $_FILES['postImage']['tmp_name'];
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	// check's valid format
	if(in_array($ext, $valid_extensions)) { 
		$postImagePath = $postImagePath.strtolower($final_image); 
		if(move_uploaded_file($tmp,$postImagePath)) {
			
			
			//echo "<img src='$postImagePath' />";
			//echo 'token is ' . $facebookToken;
			
			// Post photo in Facebook
			$_fb->uploadPhoto( $postMessage, $facebookToken, $facebookPageId, $postImagePath );
			
			if ( isset ( $_SESSION['twitterLoggedIn'] ) ) {	
				// Tweet Picture
				$_twitter->uploadTwitterPicture($postImagePath, $postMessage);
			}
		}
	} 
	else {
		echo 'invalid';
	}
}