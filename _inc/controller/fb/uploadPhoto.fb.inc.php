<?php
$data = [
		'message' => $photoMessage,
		'source' => $this->fb->fileToUpload( $_SESSION['imgTempUrl'] ),
	];
	try {
			// Upload to a user's profile. The photo will be in the
			// first album in the profile. You can also upload to
			// a specific album by using /ALBUM_ID as the path   			  
			$this->res = $this->fb->post('/' . $pageId . '/photos', $data, $pageToken);
			
			// Convert response to object
			$this->resObject = $this->res->getGraphNode();

			echo "Posted with id: " . $this->resObject['id'];

	} catch(FacebookRequestException $e) {

			echo "Exception occured, code: " . $e->getCode();
			echo " with message: " . $e->getMessage();

	}