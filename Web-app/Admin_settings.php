<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

// Query to select threads and topics
$query = "SELECT * FROM Topic as t0 JOIN Thread as t1 on t0.Topic_id = t1.Topic_id JOIN User as u on t1.User_id = u.User_id";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$stmt->execute ();
} 

catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

$rows = $stmt->fetchAll ();

include ("templates/header.php");
?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box margin-bottom">
		<div class="margin">
			<!-- CONTENT -->
			<section class="s-12 l-9 ">
				<h1>Administration Tools</h1>
				<div> <a href="reports.php" style="font-size: 115%"> Check reports </a> </div>
			</section>
		</div>
	</div>
</div>
<!-- ASIDE NAV -->

<!-- FOOTER -->
<?php

include ("templates/footer.php");
?>
