<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

	// Update views count
	$query = "DELETE FROM Thread WHERE Object_id = :object_id";
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