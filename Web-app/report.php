<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

//Create report
if(!empty($_GET))
{
	$post_id = $_GET['p_id'];
	$thread_id = $_GET['t_id'];
	$user_id = $_SESSION['user']['User_id'];

	// Query to select threads and topics
	$query = "INSERT INTO Report ( 
				Post_id,
				User_id,
				Thread_id,
				Date
			) VALUES ( 
				:Post_id,
				:User_id,
				:Thread_id,
				NOW()		
				)";
	
	$query_params = array (
			':Post_id' => $post_id,
			':User_id' => $user_id,
			':Thread_id' => $thread_id);
	
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
	$query2 = "UPDATE Report SET Reason = :reason WHERE Thread_id = :thread_id AND Post_id = :post_id";
	$query_params2 = array (
			':Reason' => $_POST ['Reason'],
			':User_id' => $_SESSION['user']['User_id'],
			':thread_id' => $_POST['thread_id'],
			':post_id' => $_POST['post_id']);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
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
			<section class="s-12 l-9 right">
				<article class="customform s-12 l-8">
				<!--Edit old post-->
				<form action="report.php" method="post">
					<p>Report User:</p>
					<div>
					<textarea name="Reason" style=" height: 121px;"><?php echo $row['Body'];?></textarea>
					</div>
					<input type="hidden" name="post_id"	value="<?php echo($_GET['p_id']);?>">
					<input type="hidden" name="thread_id"	value="<?php echo($_GET['t_id']);?>">
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
