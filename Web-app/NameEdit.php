<?php 

	// First we execute our common code to connection to the database and start the session 
	require("common.php"); 


//<!--Header-->
  $_SESSION['title'] ="Edit names";
 
  include_once("header.php");


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
          <!-- CONTENT -->
            <article class="s-12 l-8">
              <h1>Personal Settings</h1>
        <p>
        	<form method="post">
        	Name: 
        	<input type="text" name="First_name" value="<?php echo $_SESSION['user']['First_name']?>"/>
        	<input type="text" name="Last_name" value="<?php echo $_SESSION['user']['Last_name']?>"/>
        	<input type="submit" value="Save changes"/> <a href="settings.php">Cancel</a><br/>
        </form>
    	</p>
   
	      <?php

             $Username  = $_SESSION['user']['Username'];
      
              echo "<strong>Username: </strong>" . $Username;

        ?>
        <br/>

	      <?php
	      echo "<strong>Email: </strong>".htmlentities($_SESSION['user']['Email'], ENT_QUOTES, 'UTF-8'). "";
	      ?>

	      <br/>	

	      <?php
              echo "<strong>Password: </strong>********** " ;
	      ?>

	     <a href='PasswordEdit.php'>Edit Password</a><br/>
<br/><br/><br/>
        
    
    <br/><br/><br/><br/>



            </article>
            
      <!-- FOOTER -->
<?php
  include_once("footer.php");
  
?>