<?php
function getManagedPageId($pageToken){
		$req = $this->fb->sendRequest( 'GET', '/',
                                      array (
                                        'id' => $_SESSION['fbPageInformation']->$selectedFacebookPage->id,
                                      ), $pageToken
                                    );
      //getting UserGraph object
      $this->resObject = $req->getGraphObject();
		echo '<pre>';
				//var_dump ($this->resObject['id']);
				echo '</pre>';
      //return page id
      return $this->resObject['id'];
	}