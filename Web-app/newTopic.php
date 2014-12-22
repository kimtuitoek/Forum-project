<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

if(!isset($_GET['top_id']))	{}	// Something for dickbags that try to play with the url manually

// Query to select topics
$query0 = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Parent_topic_id";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query0 );
	$stmt->execute ();

$topics = $stmt->fetchAll ();

}catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

if (! empty ( $_POST ['topic_name'] )) {
	
	// Query to select threads and topics
	$query = "	INSERT 	INTO	Topic (	Creator_id,
											Name,
        									Date) 
						VALUES (	:creator_id,
									:Name,
       								 NOW())";
	
	$query_params = array (
			':creator_id' => $_SESSION ['user'] ['User_id'],
			':Name' => $_POST ['topic_name']
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}

	// Query to select threads and topics
	$query2 = "	INSERT 	INTO	Topic_relation (	Parent_topic_id,
													Child_topic_id)
						VALUES (	:parent_id,
									LAST_INSERT_ID())";
	
	$query_params2 = array (
			':parent_id' => $_GET['top_id'],
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
		
	header ( "Location: " . $_SESSION ['previous_page'] );
	die ( "Redirecting to: " . $_SESSION ['previous_page'] );
  }
   


   if(empty($_SESSION['user']))
  {
      $_SESSION['previous_page'] = "newthread.php";
      header("Location: login.php");
      die("Redirecting to: login.php");
  }
  
  $view = new viewServer();
  
  $view->topics = $topics;
  
  $view->render("newTopic.phtml");
  
  ?>
    