<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

// Query to select threads and topics
$query = "SELECT * FROM Thread as t1 JOIN User as u on t1.User_id = u.User_id";

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

<div class="line">
	<div class="box margin-bottom">
		<div class="margin">

			<!-- CONTENT -->
			<article class="customform s-12 l-8">
				<h1>Personal Settings</h1>
        <?php
								
								$First_name = $_SESSION ['user'] ['First_name'];
								$Last_name = $_SESSION ['user'] ['Last_name'];
								
								echo "Name: " . $First_name . " " . $Last_name;
								
								?>
		<br />

       <?php
							
							$Username = $_SESSION ['user'] ['Username'];
							
							echo "Username: " . $Username;
							
							?>
        <br />

        <?php
								echo "Email: " . htmlentities ( $_SESSION ['user'] ['Email'], ENT_QUOTES, 'UTF-8' ) . "";
								?>

        <br />

				<button type="button" class="s-3"
					onClick="window.location.href='NameEdit.php'"
					style="margin-right: 30px"><b>Change Name</b></button>
				<button type="button" class="s-3"
					onClick="window.location.href='PasswordEdit.php'"><b>Change Password</b></button>
				<br /> <br />


			</article>
		</div>
	</div>
</div>
<!-- FOOTER -->
<?php

include ("templates/footer.php");
?>

