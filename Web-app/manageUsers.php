<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;

$view = new viewServer();

// Query to select threads and topics
$query = "	SELECT	*
			FROM	User";

try {
	// Execute the query against the database
	$stmt = $db->prepare ($query);
	$stmt->execute ();

	$users = $stmt->fetchAll ();
} catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}


$view->users = $users;

$view->render("manageUsers.phtml");		
?>
