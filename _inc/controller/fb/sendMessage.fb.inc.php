<?php

try {
            // Send Message
			$res = $this->fb->sendRequest('POST', '/' . $pageId . '/feed', ['message' => $message, 'link' => $link ], $pageToken, 'eTag', 'v5.0');
            // Print success message
			echo 'Facebook: Message has been sent';
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: '. $e->getMessage();
				exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '. $e->getMessage();
				exit;
		}