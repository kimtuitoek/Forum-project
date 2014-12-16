<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

// Update views count
$query2 = "UPDATE Thread SET Views = :views  WHERE Thread_id = :thread_id";
$query_params2 = array (
		':thread_id' => $_GET ['id'],
		':views' => $_GET ['views'] + 1
);

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query2 );
	$result = $stmt->execute ( $query_params2 );
} catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

if (! empty ( $_POST )) {
	
	// Query to select threads and topics
	$query = "INSERT INTO Post ( 
				Body,
				User_id,
				Thread_id,
				Date
			) VALUES ( 
				:Body,
				:User_id,
				:Thread_id,
				NOW()		
				)";
	
	$query_params = array (
			':Body' => $_POST ['text_post'],
			':User_id' => $_SESSION ['user']['User_id'],
			':Thread_id' => $_POST ['thread_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Update views count
	$query2 = "UPDATE Thread SET Post_count = :count WHERE Thread_id = :thread_id";
	$query_params2 = array (
			':thread_id' => $_GET ['id'],
			':count' => $_GET ['views'] + 1
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}



header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>