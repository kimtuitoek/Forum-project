<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");
require ("viewServer.php");

// Enable or disable mature content
if (! empty ( $_POST )) {
	// This query retreives the user's information from the database using
	// their username.
	$ThreadName = $_POST ['thread_name'];
	$query = "	UPDATE	Thread 
				SET		Name = '$ThreadName' 
				WHERE	Thread_id = :thread_id";
	
	$query_params = array (
			':thread_id' => $_GET ['t_id'] 
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
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
}

// Query to select topics
$query0 = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Child_topic_id";
	
try {
	// Execute the query against the database$stmt = $db->prepare ( $query0 );
	$stmt = $db->prepare ( $query0 );
	$stmt->execute ();

	$topics = $stmt->fetchAll ();
} catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}
	
$view = new viewServer();
	
$view->topics = $topics;

$view->render("renameThread.phtml");
?>