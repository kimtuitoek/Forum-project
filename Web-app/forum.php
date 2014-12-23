<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");
require ("viewServer.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;


if(isset($_GET['top_id'])){
	$topic = $_GET['top_id'];
} else{
	$topic = 1;
}

// Query to select threads
$query = "	SELECT	*,
					t.Status as thread_status,
					t.Post_count as Post_count
			FROM	Thread as t JOIN User as u on t.User_id = u.User_id
			WHERE	t.Topic_id = :topic_id";

$query_params = array (	':topic_id' => $topic);

// Query to select topics
$query2 = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Child_topic_id";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$stmt->execute ($query_params);
	
	$rows = $stmt->fetchAll ();
	
	$stmt = $db->prepare ( $query2 );
	$stmt->execute ();
	
	$topics = $stmt->fetchAll ();
} 

catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );	
}

$view = new viewServer();

$view->rows = $rows;
$view->topics = $topics;
$view->topic = $topic;

$view->render("forum.phtml");

?>
