<?php
//GET /me/accounts
		try {
            // Request information from Facebook
			$this->res = $this->fb->sendRequest('GET', '/me/accounts', array() , $_SESSION['facebook_access_token']);
            
            // Use the information obtained from the request to obtain the page information like Page Name, Page Access Token and Page ID (Test)
            
            // Convert response to object
			$this->resObject = $this->res->getGraphEdge();
            
            // FOR DEBUG: Print all items in response object
				//print_r ($this->resObject);
			
            // Start loop to read response object
            $i = 0;
			$this->fbPageInformation = new stdClass();
            
            // Set up HTML - Table Format
    ?>	<div class="container-fluid">
					<h3>Select Page To Manage:</h3>
					<table class="table">
					<thead>
					<tr>
					  <th scope="col">Page Name</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
    <?php
			 $this->fbInformation = new stdClass();
			foreach ($this->resObject as $this->resObjectResponse) {
                // Print each page information on its own table row
				echo '<tr><td>' . $this->resObjectResponse['name'] . '</td><td><a href="?manageSelectedFacebookPage=' . $i . '">Use This Token</a></td></tr>';
				
                // Store row information on new object for further reference
				$this->fbPageInformation->$i = new stdClass();
				$this->fbPageInformation->$i->pageName = $this->resObjectResponse['name'];
				$this->fbPageInformation->$i->pageToken = $this->resObjectResponse['access_token'];
				$this->fbPageInformation->$i->id = $this->resObjectResponse['id'];
                
				$pgName = $this->resObjectResponse['id'];
                $this->fbInformation->$pgName = new stdClass();
				$this->fbInformation->$pgName->facebook = $this->fbPageInformation->$i;
				$i++;
			  }
				//echo '<pre>';
					//print_r( $this->fbInformation );
				//echo '</pre>';
				if( !isset( $_SESSION['userInformation'] ))
					$_SESSION['userInformation'] = $this->fbInformation;
				
//				echo '<pre>';
//					print_r($_SESSION['userInformation']);
//				echo '</pre>';
    ?>  
					</table>
				</div>
				
    <?php
			// Store completed response object information in server session
            $_SESSION['fbPageInformation'] = $this->fbPageInformation;
				//print_r ($_SESSION['fbPageInformation']);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: '. $e->getMessage();
				exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '. $e->getMessage();
				exit;
		}