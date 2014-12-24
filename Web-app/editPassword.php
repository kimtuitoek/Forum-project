<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");

// This if statement checks to determine whether the login form has been submitted
// If it has, then the login code is run, otherwise the form is displayed
if (! empty ( $_POST )) {
	$validation_passed = True;
	
	// This query retreives the user's information from the database using
	// their username.
	
	if (empty ( $_POST ['password'] )) {
		// Note that die() is generally a terrible way of handling user errors
		// like this. It is much better to display the error with the form
		// and allow the user to correct their mistake. However, that is an
		// exercise for you to implement yourself.
		
		// Toss: Should totally figure out how to do this...
		$error ['password'] = "Please enter a password";
		$validation_passed = False;
	} 	

	// Check whether confirmed password and entered password are the same
	else if ($_POST ['password'] != $_POST ['confirm_password']) {
		$error ['confirm'] = "Passwords do not match";
		$validation_passed = False;
	} 

	else if ($validation_passed) {
		// A salt is randomly generated here to protect again brute force attacks
		// and rainbow table attacks. The following statement generates a hex
		// representation of an 8 byte salt. Representing this in hex provides
		// no additional security, but makes it easier for humans to read.
		// For more information:
		// http://en.wikipedia.org/wiki/Salt_%28cryptography%29
		// http://en.wikipedia.org/wiki/Brute-force_attack
		// http://en.wikipedia.org/wiki/Rainbow_table
		$salt = dechex ( mt_rand ( 0, 2147483647 ) ) . dechex ( mt_rand ( 0, 2147483647 ) );
		
		$password = hash ( 'sha512', $_POST ['password'] . "-" . S_Pswd_Salt );
		$i_Email = $_SESSION ['user'] ['Email'];
		$query = "UPDATE User SET Password = '$password' WHERE Email = :Email";
		
		$query_params = array (
				':Email' => $_SESSION ['user'] ['Email'] 
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
		$_SESSION ['user'] ['Password'] = $password;
		
		header ( "Location: userSettings.php" );
		die ( "Redirecting to: userSettings.php" );
	}
}

$view = new viewServer();

$view->render("editPassword.phtml");

?>
