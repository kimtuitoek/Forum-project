<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

if (! empty ( $_GET )) {
	// Query to select threads and topics
	$query = "	SELECT	*
				FROM	Post 
				WHERE	Post_id = :p_id";
	
	$query_params = array (
			':p_id' => $_GET ['p_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$post = $stmt->fetch ();
}

if (! empty ( $_POST )) {

	$query2 = "	INSERT	
				INTO History (	Body, 
								Post_id, 
								Date, 
								User_id)
				VALUES(	:Body, 
						:p_id, 
						NOW(), 
						:u_id)";
	$query_params2 = array (
			':Body' => $_POST ['old_body'],
			':p_id' => $_POST ['p_id'],
			':u_id' => $_SESSION ['user'] ['User_id']
	);
		
	$query3 = "	UPDATE	Post
				SET 	Body = :text_post, Date = NOW()
				Where 	Post_id = :p_id";
	$query_params3 = array (
			':text_post' => $_POST ['text_post'],
			':p_id' => $_POST ['p_id'],  
	);
	

	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
		
		$stmt = $db->prepare ( $query3 );
		$result2 = $stmt->execute ( $query_params3 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	if (isset ( $_SESSION ['previous_page'] )) {
		header ( "Location: " . $_SESSION ['previous_page'] );
		die ( "Redirecting to: " . $_SESSION ['previous_page'] );
	}
	
	header ( "Location: " . $_SESSION ['previous_page'] );
	die ( "Redirecting to: " . $_SESSION ['previous_page'] );
}
	
$view = new viewServer();
	
$view->post = $post;

$view->render("editPost.phtml");
?>
