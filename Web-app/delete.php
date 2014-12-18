<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

	// Try to delete the object as if it where a thread
	try {
		$query = "DELETE FROM Thread WHERE Object_id = :object_id";
		$query_params = array (
				':object_id' => $_GET ['obj'],
		);
		
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch (Exception $e) {
	}

	// Try to delete the object as if it where a post
	try {
		$query2 = "DELETE FROM Post WHERE Object_id = :object_id";
		$query_params2 = array (
				':object_id' => $_GET ['obj'],
		);
		
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
	} catch (Exception $e) {
	}
	
if (isset($_GET['db'])) $_SESSION ['previous_page'] = $_SESSION ['previous_previous_page'];
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>