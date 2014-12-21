<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

if (! empty ( $_POST ['thread_name'] ) && ! empty($_POST['thread_name'])) {
	
	// Query to select threads and topics
	$query = "	INSERT 
				INTO	Thread (	User_id,
									Name,
        							Date,
        							Object_id) 
									VALUES (	:User_id,
												:Name,
       											 NOW(),
        										:Object_id)";
	
	$Object_id = sha1 ( $_POST ['thread_name'] . date ( "h:i:sa" ) );
	
	$query_params = array (
			':User_id' => $_SESSION ['user'] ['User_id'],
			':Name' => $_POST ['thread_name'],
			':Object_id' => $Object_id,
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
				WHERE 	Object_id = :obj_id";
	$query_params2 = array (
			':obj_id' => $Object_id
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$thread = $stmt->fetch ();
	
	// Query to select threads and topics
	$query3 = "	INSERT
				INTO	Post ( Body,
								User_id,
								Thread_id,
								Date,
       							Object_id)
								VALUES (	:Body,
											:User_id,
											:Thread_id,
											NOW(),
											:Object_id)";
	
	$Object_id = sha1 ( $_POST ['text_post'] . date ( "h:i:sa" ) );
	
	$query_params3 = array (
			':Body' => $_POST ['text_post'],
			':User_id' => $_SESSION ['user']['User_id'],
			':Object_id' => $Object_id,
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
  
  $view = new viewServer();
  
  $view->render("newThread.phtml");
  
  ?>
    