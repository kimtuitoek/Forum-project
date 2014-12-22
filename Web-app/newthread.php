<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");
	
if (! empty ( $_POST ['thread_name'] ) && ! empty($_POST['text_post'])) {
	
	// Query to select threads and topics
	$query = "	INSERT 
				INTO	Thread (	User_id,
									Name,
									Topic_id,
        							Date) 
									VALUES (	:User_id,
												:Name,
												:topic_id,
       											 NOW())";
	
	$query_params = array (
			':User_id' => $_SESSION ['user'] ['User_id'],
			':Name' => $_POST ['thread_name'],
			':topic_id' => $_GET['top_id']
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Query to select threads and topics
	$query2 = "	SELECT	 *
				FROM 	Thread
				WHERE 	Thread_id = LAST_INSERT_ID()";
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$stmt->execute ( );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$thread = $stmt->fetch ();
	
	// Query to select threads and topics
	$query3 = "	INSERT
				INTO	Post (	Body,
								User_id,
								Thread_id,
								Date)
								VALUES (	:Body,
											:User_id,
											:Thread_id,
											NOW())";
	
	$query_params3 = array (
			':Body' => $_POST ['text_post'],
			':User_id' => $_SESSION ['user']['User_id'],
			':Thread_id' => $thread ['Thread_id']
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query3 );
		$result = $stmt->execute ( $query_params3 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
		
	header ( "Location: thread.php?id=" . $thread['Thread_id']);
	die ( "Redirecting to: thread.php?id=" . $thread['Thread_id']);
  }
   
   if(empty($_SESSION['user']))
  {
      $_SESSION['previous_page'] = "newthread.php";
      header("Location: login.php");
      die("Redirecting to: login.php");
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
  
  $view = new viewServer();
  
  $view->topics = $topics;
  
  $view->render("newThread.phtml");
  
  ?>
    