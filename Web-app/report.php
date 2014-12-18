<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

//Create report
if(!empty($_GET))
{	
	// Query to select threads and topics
	$query = "INSERT INTO Report (
				User_id, 
				Object_id,
				Date
			) VALUES ( 
				:User_id,
				:object_id,
				NOW()		
				)";
	
	$query_params = array (
			':object_id' => $_GET['obj'],
			':User_id' => $_SESSION['user']['User_id']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}

}

if(!empty($_POST))
{
	// Query to select threads and topics
	$query = "INSERT INTO Report (
				User_id,
				Object_id,
				Date
			) VALUES (
				:User_id,
				:object_id,
				NOW()
				)";
	
	$query_params = array (
			':object_id' => $_POST['object_id'],
			':User_id' => $_SESSION['user']['User_id']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$query2 = "UPDATE Report SET Reason = :reason WHERE Object_id = :object_id AND User_id = :user_id";
	$query_params2 = array (
			':reason' => $_POST ['Reason'],
			':user_id' => $_SESSION['user']['User_id'],
			':object_id' => $_GET['obj']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
		header("Location: ". $_SESSION['previous_page']);
		die("Redirecting to: ". $_SESSION['previous_page']);
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}

include ("templates/header.php");
?>


<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box">
		<div class="margin">
			<!-- CONTENT -->
			<?php echo $_GET['obj']; ?>
			<section class="s-12 l-9 right">
				<article class="customform s-12 l-8">
				<!--Edit old post-->
				<form action="report.php" method="post">
					<p>Report for report</p>
					<div>
					<textarea name="Reason" style=" height: 121px;"></textarea>
					</div>
					<div style="display: inline">
						<button class="s-3" type="submit" style="margin-right: 30px">Report</button>
						<button class="s-3" type="button" onclick="history.go(-1)"><b>Cancel</b></button>
					</div>
				</form>
			</article>
			</section>
		</div>
	</div>
</div>	
<!-- FOOTER -->
<?php include ("templates/footer.php"); ?>
