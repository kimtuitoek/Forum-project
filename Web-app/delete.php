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
			
			$_SESSION ['previous_page'] = $_SESSION ['previous_previous_page'];
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
		
			// Update post count for that the thread
			$query3 = "	UPDATE	Thread
						SET		Post_count = Post_count - 1
						WHERE	Object_id = :object_id";
		
			$query_params3 = array (
					':object_id' => $thread ['Object_id'],
			);
		
			$stmt = $db->prepare ( $query3 );
			$result = $stmt->execute ( $query_params3 );
		
			$query4 = "	DELETE
						FROM 	Post
						WHERE	Post_id = :post_id";
			$query_params4 = array (
					':post_id' => $_GET ['p_id'],
			);
		
			$stmt = $db->prepare ( $query4 );
			$result = $stmt->execute ( $query_params4 );
		} catch (Exception $e) {
		}	
	}
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
?>
