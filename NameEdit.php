<?php 

	// First we execute our common code to connection to the database and start the session 
	require("common.php"); 


//<!--Header-->
  $_SESSION['title'] ="Edit names";
 
  include_once("templates/header.php");


  //Enable or disable mature content
  if(!empty($_POST))
  {
    // This query retreives the user's information from the database using 
		// their username. 
		$FirstName = $_POST['First_name'];
		$LastName = $_POST['Last_name'];
		$i_Email = $_SESSION['user']['Email'];
		$query = "UPDATE User SET First_name = '$FirstName', Last_name = '$LastName' WHERE Email = :Email"; 

		$query_params = array( 
			':Email' => $_SESSION['user']['Email'] 
			); 

		try 
		{ 
			// Execute the query against the database 
			$stmt = $db->prepare($query); 

			$stmt->execute($query_params); 


		} 
		catch(PDOException $ex) 
		{ 
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		} 
			$_SESSION['user']['First_name'] = $FirstName;
			$_SESSION['user']['Last_name'] = $LastName;

			header("Location: settings.php"); 
			die("Redirecting to: settings.php"); 

	}
     
?>
    
	<!-- ASIDE NAV AND CONTENT -->
	<div class="line">
		<div class="box margin-bottom">
			<div class="margin">
				<article class="customform s-12 l-8">
				<h1>Change Name</h1>
				<p>
					<form method="post">
						First Name<input type="text" name="First_name" value="<?php echo $_SESSION['user']['First_name']?>"/>
						Last Name<input type="text" name="Last_name" value="<?php echo $_SESSION['user']['Last_name']?>"/>
						<button type="submit" class="s-3" style="margin-right: 30px">Save changes</button> 
						<button type="button" class="s-3" onClick="window.location.href='settings.php'">Cancel</button><br/>
					</form>
				</p>
				</article>
			</div>
		</div>
	</div>
   
            
      <!-- FOOTER -->
<?php
  include_once("templates/footer.php");
  
?>