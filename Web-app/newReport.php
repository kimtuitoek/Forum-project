<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

$view = new viewServer();

//Create report
if(!empty($_GET))
{	
	// Query to select threads and topics
	$query = "	Select	o.Object_id as Object_id,
						t.Thread_id as Thread_id, 
						p.Thread_id as PThread_id, 
						p.Post_id as Post_id
				FROM	Object as o LEFT JOIN Thread as t on o.Object_id = t.Object_id LEFT JOIN Post as p on o.Object_id = p.Object_id
				WHERE	o.Object_id = :object_id";
	
	$query_params = array (
			':object_id' => $_GET['obj']);

	// Query to select topics
	$query2 = "	SELECT	*
				FROM	Topic LEFT JOIN Topic_relation on Topic_id = Child_topic_id";
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
		
		$result = $stmt->fetch ();
		
		$view->result = $result;
	
		$stmt = $db->prepare ( $query2 );
		$stmt->execute ();
	
		$topics = $stmt->fetchAll ();
		
		$view->topics = $topics;
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$view->render("newReport.phtml");
}

if(!empty($_POST)){
	// Query to select threads and topics
	$query = "INSERT INTO Report (
				User_id,
				Reason,
				Thread_id,
				Post_id,
				Object_id,
				Date
			) VALUES (
				:user_id,
				:reason,
				:thread_id,
				:post_id,
				:object_id,
				NOW()
				)";
	
	$query_params = array (
			':user_id' => $_SESSION['user']['User_id'],
			':reason' => $_POST['Reason'],
			':thread_id' => $_POST['t_id'],
			':post_id' => $_POST['p_id'],
			':object_id' => $_POST['obj_id']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}

	header ( "Location: " . $_SESSION ['previous_page'] );
	die ( "Redirecting to: " . $_SESSION ['previous_page'] );	
}
