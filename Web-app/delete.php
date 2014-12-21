<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

	if(isset($_GET['t_id'])){
		// Try to delete the object as if it where a thread
		try {
			$query = "	DELETE
						FROM	Thread
						WHERE	Thread_id = :thread_id";
			$query_params = array (
					':thread_id' => $_GET ['t_id'],
			);
		
			$stmt = $db->prepare ( $query );
			$result = $stmt->execute ( $query_params );
		} catch (Exception $e) {
		}
	}

	if (isset($_GET['bt_id'])){
		//Set the previous page appropriatly so as to not show an empty thread
		$_SESSION ['previous_page'] = $_SESSION ['previous_previous_page'];
		
		// Try to delete the object as if it where a thread
		try {
			$query = "	DELETE
						FROM	Thread
						WHERE	Thread_id = :thread_id";
			$query_params = array (
					':thread_id' => $_GET ['bt_id'],
			);
		
			$stmt = $db->prepare ( $query );
			$result = $stmt->execute ( $query_params );
			} catch (Exception $e) {
		}
	}
	
	if(isset($_GET['p_id'])){
		// Try to delete the object as if it where a post
		try {
			// Find the thread that this post belongs to
			$query2 = "	Select	t.Object_id as Object_id
						FROM 	Thread as t, Post as p
						WHERE	p.Post_id = :post_id
							AND	t.Thread_id = p.Thread_id";
			$query_params2 = array (
					':post_id' => $_GET ['p_id'],
			);
		
			$stmt = $db->prepare ( $query2 );
			$result = $stmt->execute ( $query_params2 );
		
			$thread = $stmt->fetch ();
						
			$query3 = "	DELETE
						FROM 	Post
						WHERE	Post_id = :post_id";
			$query_params3 = array (
					':post_id' => $_GET ['p_id'],
			);
		
			$stmt = $db->prepare ( $query3 );
			$result = $stmt->execute ( $query_params3 );
			
			if($thread['Post_count'] == 0){
				$_SESSION ['previous_page'] = $_SESSION ['previous_previous_page'];
			}
		} catch (Exception $e) {
		}	
	}
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>
