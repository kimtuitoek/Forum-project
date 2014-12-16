<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

	// Update views count
	$query = 	"UPDATE Thread 
				SET Status = :1  
				WHERE Object_id = :object_id
				AND Status = 0 ";
	$query_params = array (
			':object_id' => $_GET ['obj'],
	);

	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Update views count
	$query = 	"UPDATE Thread
				SET Status = :0
				WHERE Object_id = :object_id
				AND Status = 1 ";
	$query_params = array (
			':object_id' => $_GET ['obj'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>