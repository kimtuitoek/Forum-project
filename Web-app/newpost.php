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
							Date) 
							VALUES (	:Body,
										:User_id,
										:Thread_id,
										NOW())";
	
	$query_params = array (
			':Body' => $_POST ['text_post'],
			':User_id' => $_SESSION ['user']['User_id'],
			':Thread_id' => $_POST ['thread_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}

header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>