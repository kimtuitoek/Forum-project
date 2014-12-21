<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

if(isset($_GET['t_id'])){
	// Update views count
	$query = 	"UPDATE Thread
				SET Status = IF(Status=1, 0, 1)
				WHERE Thread_id = :thread_id ";
	$query_params = array (
			':thread_id' => $_GET ['t_id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}

if(isset($_GET['p_id'])){
	// Update views count
	$query = 	"UPDATE Post
				SET Status = IF(Status=1, 0, 1)
				WHERE Post_id = :post_id ";
	$query_params = array (
			':post_id' => $_GET ['p_id'],
	);

	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}

header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>