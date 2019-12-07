<?php
// Require loader file
require_once('_inc/loader.inc.php');
// Start Facebook Custom Class
$_fb = new facebookCustom();

$facebookUserId =  $_fb->getUserInformation()['id'];
if ( $_sql->checkIt( 'select tokens from iu_users where facebookId = "' . $facebookUserId . '"' ) == false ) {
	$query = "insert into iu_users ( facebookId, date_created ) values ( :facebookId, now() )";
	$queryRequest = $_sql->status->prepare( $query );
	$queryRequest->bindParam(':facebookId', $facebookUserId, PDO::PARAM_INT);
	$queryRequest->execute();
	//$queryRequest->debugDumpParams();
	header("location: " . APP_URL . "?userSignUp=true");
} else {
	header("location: " . APP_URL);
	echo '<h1>User Already Registered</h1>';
	exit();
}