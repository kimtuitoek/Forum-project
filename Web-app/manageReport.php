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
	
	if(isset($report['Post_id'])){
		// Query to select threads and topics
		$query = "	SELECT	*
					FROM	Report JOIN Post as p on Object_id = p.Object_id
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
			
		$view->render("managePostReport.phtml");
	}else{
		// Query to select threads and topics
		$query = "	SELECT	*
					FROM	Report JOIN Thread as t on Object_id = t.Object_id
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
	
		$view->render("manageThreadReport.phtml");		
	}
}
?>
