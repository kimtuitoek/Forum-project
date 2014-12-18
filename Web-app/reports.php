<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

// Store previoue page location
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] ;

// Query to select threads and topics
$query = "SELECT *, r.User_id as User_id, r.Object_id as Object_id, r.Date as Date, p.Post_id as Post_id FROM Report as r JOIN User as u on r.User_id = u.User_id JOIN Post as p on r.Object_id = p.Object_id ORDER BY r.Date";

try {
	// Execute the query against the database
	$stmt = $db->prepare ( $query );
	$stmt->execute ();
} 

catch ( PDOException $ex ) {
	die ( "Failed to run query: " . $ex->getMessage () );
}

if (!isset($row['Post_id'])){
	// Query to select threads and topics
	$query2 = "SELECT *, r.User_id as User_id, r.Object_id as Object_id, r.Date as Date, t.Thread_id as Thread_id  FROM Report as r JOIN User as u on r.User_id = u.User_id JOIN Thread as t on r.Object_id = t.Object_id";
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$stmt->execute ();
	}
	
	catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
}

$rows = $stmt->fetchAll ();

include ("templates/header.php"); ?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box">
		<div class="margin">
			<!-- CONTENT -->
			<section class="s-12 l-12 ">
				<h1>Threads</h1>
				<div class="margin">
					<table class="responstable">
						<tr>
							<?php if (!isset($_SESSION['user']['Priviledge'])) :?>
							<?php elseif ($_SESSION['user']['Priviledge'] >= 1) :?>
								<th>Report ID</th>
								<th>Object Type</th>
								<th>User ID</th>
								<th>Date</th>
								<th>Options</th></tr>
							<?php endif ?>
							 <?php foreach ( $rows as $row ) :?> <tr>
								<td><a href="manage_report.php?obj=<?php echo($row['Report_id'])?>"> <?php echo $row['Report_id'];?> 
								</a></td>
								<?php if (isset($row['Post_id'])) :?>								
								<td> Post </td>
								<?php else : ?>					
								<td> Thread </td>						
								<?php endif ?>
								<td> <?php echo $row['User_id']; ?></td>
								<td> <?php echo $row['Date']; ?> </td>
								<td> <?php echo $row['Object_id']; ?> </td>
								</tr>
	 						 <?php endforeach ?>
					</table>

				</div>
			</section>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php include ("templates/footer.php"); ?>