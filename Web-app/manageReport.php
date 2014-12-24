<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;

if(!empty($_GET)){
	// Query to select threads and topics
	$query = "	SELECT	*
				FROM	Report
				WHERE	Report_id = :report_id";
	$query_params = array (	':report_id' => $_GET['r_id']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ($query);
		$stmt->execute ($query_params);
	
		$report = $stmt->fetch ();
	} 
	
	catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	
	$view = new viewServer();
	

	// Query to select all posts in the thread of the reported post
	$query2 = "	SELECT	*,
			 			p.User_id as User_id,
			 			p.Object_id as Object_id
				FROM	Post as p JOIN User as u on p.User_id = u.User_id JOIN Thread as t on t.Thread_id = p.Thread_id
				WHERE	t.Thread_id = :thread_id";
	
	$query_params2 = array (
			':thread_id' => $report['Thread_id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ($query2);
		$stmt->execute ($query_params2);
	
		$rows = $stmt->fetchAll ();
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Query to select all posts in this thread
	$query3 = "	SELECT	*
				FROM	Thread
				WHERE	Thread_id = :thread_id";
	
	$query_params3 = array (
			':thread_id' => $report['Thread_id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query3 );
		$result = $stmt->execute ( $query_params3 );
			
		$thread = $stmt->fetch ();
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$view->thread = $thread;
	$view->rows = $rows;
	
	if($report['Post_id'] != 0){
		// Query to the reported post
		$query = "	SELECT	*
					FROM	Report as r JOIN Post as p on r.Object_id = p.Object_id
					WHERE	Report_id = :report_id";
		$query_params = array (	':report_id' => $_GET['r_id']);
		
		try {
			// Execute the query against the database
			$stmt = $db->prepare ($query);
			$stmt->execute ($query_params);
			
			$report = $stmt->fetch ();
		} catch ( PDOException $ex ) {
			die ( "Failed to run query: " . $ex->getMessage () );
		}
				
		$view->report = $report;
			
		$view->render("manageReport.phtml");
	}else{
		// Query to select threads and topics
		$query = "	SELECT	*
					FROM	Report as r JOIN Thread as t on r.Object_id = t.Object_id
					WHERE	Report_id = :report_id";
		$query_params = array (	':report_id' => $_GET['r_id']);
		
		try {
			// Execute the query against the database
			$stmt = $db->prepare ($query);
			$stmt->execute ($query_params);
		
			$report = $stmt->fetch ();
		} catch ( PDOException $ex ) {
			die ( "Failed to run query: " . $ex->getMessage () );
		}
		
		$view->report = $report;
	
		$view->render("manageReport.phtml");		
	}
}
?>
