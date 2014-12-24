<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;

// Query to select threads and topics
$query = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Child_topic_id";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$stmt->execute ();

	$rows = $stmt->fetchAll ();
} 

catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}


$view = new viewServer();

$view->topics = $rows;

$view->render("inspectTopics.phtml");

?>
