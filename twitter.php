<?php

use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'Vkp5s2AZbwrPunCGW0JA7Uk8D');
define('CONSUMER_SECRET', 'NH5YH2LugwEnrnJIIAZcFQru6L3uqBxWUW15VcIdDtII7hsTzb');
define('ACCESS_TOKEN', '188578770-SvwESKtyRDSZqSXVhBezGWtq13c3hLaikpGUGEC3');
define('ACCESS_TOKEN_SECRET', 'QboEU3KQaydbFUDAfeRHU2O8u87keuOff54i94rDzipAY');
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$status = 'This is a test tweet 3. https://gilbertocortez.com'; //text for your tweet.
$post_tweets = $connection->post("statuses/update", ["status" => $status]);