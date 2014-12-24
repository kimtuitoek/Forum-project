<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

$view = new viewServer();

if(isset($_GET['u_id'])){
	// Query to the specific user to be managed
	$query = "	SELECT	*	
				FROM	User
				WHERE	User_id = :user_id";
	$query_params = array(
			':user_id' => $_GET['u_id']
			);
	
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ($query);
		$stmt->execute ($query_params);
		
		$user = $stmt->fetch();
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$view->user = $user;
	
	$view->render("manageUser.phtml");		
}

if(!empty($_POST)){	
	// Query to the specific user to be managed
	$query = "	UPDATE	User
				SET		Status = :status,
						Priviledge = :priviledge
				WHERE	User_id = :user_id";
	$query_params = array(
			':user_id' => $_POST['user_id'],
			':priviledge' => $_POST['priviledge'],
			':status' => $_POST['status']
	);
	
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ($query);
		$stmt->execute ($query_params);
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	header ( "Location: " . $_SESSION ['previous_page'] );
	die ( "Redirecting to: " . $_SESSION ['previous_page'] );
}
?>
