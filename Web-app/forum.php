<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");
require ("viewServer.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;

// Query to select threads
$query = "	SELECT	*,
					t.Status as thread_status,
					t.Post_count as Post_count
			FROM	Thread as t JOIN User as u on t.User_id = u.User_id";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$stmt->execute ();
} 

catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

$rows = $stmt->fetchAll ();

$view = new viewServer();

$view->rows = $rows;

$view->render("forum.phtml");

?>
