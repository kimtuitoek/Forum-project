<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

// <!--Header-->
$_SESSION ['title'] = "Edit names";

include_once ("templates/header.phtml");

// Enable or disable mature content
if (! empty ( $_POST )) {
	// This query retreives the user's information from the database using
	// their username.
	$FirstName = $_POST ['First_name'];
	$LastName = $_POST ['Last_name'];
	$i_Email = $_SESSION ['user'] ['Email'];
	$query = "UPDATE User SET First_name = '$FirstName', Last_name = '$LastName' WHERE Email = :Email";
	
	$query_params = array (
			':Email' => $_SESSION ['user'] ['Email'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		
		$stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		// Note: On a production website, you should not output $ex->getMessage().
		// It may provide an attacker with helpful information about your code.
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	$_SESSION ['user'] ['First_name'] = $FirstName;
	$_SESSION ['user'] ['Last_name'] = $LastName;
	
	header ( "Location: settings.php" );
	die ( "Redirecting to: settings.php" );
}

$view = new viewServer();

$view->render("editName.phtml");

?>
