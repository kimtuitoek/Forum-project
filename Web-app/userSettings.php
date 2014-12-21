<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'];

// Query to select threads and topics
$query = "	SELECT	*
			FROM	User
			WHERE	User_id = :userid";

$query_params = array (
		':userid' => $_SESSION ['user']['User_id'],
	);
	try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$result = $stmt->execute ( $query_params );
	
	$row = $stmt->fetch();
	$_SESSION ['user'] = $row;
		
} catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

$view = new viewServer();

$view->render("userSettings.phtml");

?>
