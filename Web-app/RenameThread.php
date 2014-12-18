<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");

// <!--Header-->
$_SESSION ['title'] = "Edit names";

include_once ("templates/header.php");

// Enable or disable mature content
if (! empty ( $_POST )) {
	// This query retreives the user's information from the database using
	// their username.
	$ThreadName = $_POST ['thread_name'];
	$query = "UPDATE Thread SET Name = '$ThreadName' WHERE Object_id = :Obj_ID";
	
	$query_params = array (
			':Obj_ID' => $_GET ['obj'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		
		$stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		// Note: On a production website, you should not output $ex->getMessage().
		// It may provide an attacker with helpful information about your code.
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
header ( "Location: " . $_SESSION ['previous_page'] );
die ( "Redirecting to: " . $_SESSION ['previous_page'] );
}

$url = "window.location.href=" . $_SESSION ['previous_page'] ;

?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box margin-bottom">
		<div class="margin">
			<article class="customform s-12 l-8">
				<h1>Change Name</h1>
				<form method="post">
					New Name <input type="text" name="thread_name" value="">
					<button type="submit" class="s-3" style="margin-right: 30px">Save changes</button>
					<button type="button" class="s-3" onClick="back()"><b>Cancel</b></button>
					<br />
				</form>
			</article>
		</div>
	</div>
</div>


<!-- FOOTER -->
<?php
include_once ("templates/footer.php");
  
?>