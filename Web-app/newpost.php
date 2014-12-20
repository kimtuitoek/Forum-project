<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
 if(empty($_SESSION['user']))
  {
      header("Location: login.php");
      die("Redirecting to: login.php");
  }

if (! empty ( $_POST )) {
	
	// Query to select threads and topics
	$query = "	INSERT 
				INTO Post ( Body,
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
	
	$query_params = array (
			':Body' => $_POST ['text_post'],
			':User_id' => $_SESSION ['user']['User_id'],
			':Object_id' => $Object_id,
			':Thread_id' => $_POST ['thread_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Update post count for the thread
	$query2 = "	UPDATE	Thread 
				SET		Post_count = Post_count + 1,
						Views = Views - 1
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
}



header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>