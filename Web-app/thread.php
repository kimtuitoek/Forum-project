<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");
require ("viewServer.php");

$_SESSION ['previous_previous_page'] = $_SESSION ['previous_page'];
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] . "?id=" . $_GET ['id'];

$view = new viewServer();

if (! empty ( $_GET )) {
	// Query to select all posts in this thread
	$query = "	SELECT	*,
			 			p.User_id as User_id,
			 			p.Object_id as Object_id 
				FROM	Post as p JOIN User as u on p.User_id = u.User_id JOIN Thread as t on t.Thread_id = p.Thread_id 
				WHERE	t.Thread_id = :thread_id";
	
	$query_params = array (
			':thread_id' => $_GET ['id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$rows = $stmt->fetchAll ();
	
	// Query to select all posts in this thread
	$query2 = "	SELECT	*
				FROM	Thread 
				WHERE	Thread_id = :thread_id";
	
	$query_params2 = array (
			':thread_id' => $_GET ['id'],
	);
		
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$thread = $stmt->fetch ();
	
	// Update views count
	$query3 = "	UPDATE	Thread
				SET		Views = Views + 1  
				WHERE	Thread_id = :thread_id";
	$query_params3 = array (
			':thread_id' => $_GET ['id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query3 );
		$result = $stmt->execute ( $query_params3 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
  
	// Query to select topics
	$query0 = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Parent_topic_id";
  
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query0 );
		$stmt->execute ();
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
  
	$topics = $stmt->fetchAll ();
  
 	$view->topics = $topics;
	$view->rows = $rows;
	$view->thread = $thread;

	$view->render("thread.phtml");
	
}
		
?>
		