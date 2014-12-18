<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

if (! empty ( $_GET )) {
	// Query to select threads and topics
	$query = "SELECT * FROM Post as p JOIN User as u on p.User_id = u.User_id JOIN Thread as t on t.Thread_id = p.Thread_id Where t.Thread_id = :t_id AND p.Post_id = :p_id";
	
	$query_params = array (
			':t_id' => $_GET ['t_id'],
			':p_id' => $_GET ['p_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$row = $stmt->fetch ();
	$_SESSION ['user'] ['Post'] [$_GET ['p_id']] = $row ['Body'];
}

if (! empty ( $_POST )) {
	$query = "UPDATE Post SET Body = :text_post, Date = NOW() Where Post_id = :p_id";
	$query2 = "INSERT INTO History (Body, Post_id, Date, User_id)
                      VALUES(:Body, :p_id, NOW(), :u_id)";
	$query_params = array (
			':text_post' => $_POST ['text_post'],
			':p_id' => $_POST ['post_id'] 
	);
	
	$query_params2 = array (
			':Body' => $_SESSION ['user'] ['Post'] [$_POST ['post_id']],
			':p_id' => $_POST ['post_id'],
			':u_id' => $_SESSION ['user'] ['User_id'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
		
		$stmt = $db->prepare ( $query2 );
		$result2 = $stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	if (isset ( $_SESSION ['previous_page'] )) {
		header ( "Location: " . $_SESSION ['previous_page'] );
		die ( "Redirecting to: " . $_SESSION ['previous_page'] );
	}
}

include_once ("templates/header.php");
?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box">
		<div class="margin">
			<!-- CONTENT -->
			<section class="s-12 l-9 right">
				<!--Edit old post-->
				<form action="edit-post.php" method="post"
					class="customform s-12">
					<p>Edit Post:</p>
					<textarea name="text_post" style="width: 808px; height: 121px;"><?php echo $row['Body'];?></textarea>
					<input type="hidden" name="post_id"
						value="<?php echo($_GET['p_id']);?>">
					<div class="s-2">
						<button type="submit" >Post</button>
						<button type="button" onclick="history.go(-1)"><b>Back</b></button>
					</div>
				</form>
			</section>
		</div>
	</div>
</div>

		<!-- FOOTER -->
<?php

include_once ("templates/footer.php");
?>
