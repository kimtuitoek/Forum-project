<?php

// Code provided from:
// http://forums.devshed.com/php-faqs-and-stickies-167/how-to-program-a-basic-but-secure-login-system-using-891201.html

// Toss: Should insert this code into a tempate .html page
// Toss: I have removed code related to username, since we aren't using those

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("validation.php");
require ("viewServer.php");

// This if statement checks to determine whether the registration form has been submitted
// If it has, then the registration code is run, otherwise the form is displayed
if (! empty ( $_POST )) {
	$validation_passed = validate ( $_POST );
	
	// Initialize post variables
	$first_name = $_POST ['first_name'];
	$last_name = $_POST ['last_name'];
	$email = $_POST ['email'];
	$username = $_POST ['username'];
	
	// We will use this SQL query to see whether the username entered by the
	// user is already in use. A SELECT query is used to retrieve data from the database.
	// :username is a special token, we will substitute a real value in its place when
	// we execute the query.
	
	$query = "
				SELECT	1
				FROM	User
				WHERE	Username = :username
			";
	
	$query_params = array (
			':username' => $_POST ['username'] 
	);
	
	try {
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} 

	catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$row = $stmt->fetch ();
	
	if ($row) {
		$_SESSION ['error'] ['username'] = "This Username is already registered";
		$validation_passed = False;
	}
	
	// Now we perform the same type of check for the email Username, in order
	// to ensure that it is unique.
	
	$query = " 
				SELECT	1 
				FROM	User 
				WHERE	Email = :email 
			";
	
	$query_params = array (
			':email' => $_POST ['email'] 
	);
	
	try {
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} 

	catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$row = $stmt->fetch ();
	
	if ($row) {
		$_SESSION ['error'] ['email'] = "This email Username is already registered";
		$validation_passed = False;
	}
	
	if ($validation_passed) {
		// An INSERT query is used to add new rows to a database table.
		// Again, we are using special tokens (technically called parameters) to
		// protect against SQL injection attacks.
		$query = " 
			INSERT INTO User ( 
				Password,
				Email,
				First_name,
				Last_name,
				Username
			) VALUES ( 
				:password,
				:email,
				:first_name,
				:last_name,
				:username
			) 
		";
		
		// A salt is randomly generated here to protect again brute force attacks
		// and rainbow table attacks. The following statement generates a hex
		// representation of an 8 byte salt. Representing this in hex provides
		// no additional security, but makes it easier for humans to read.
		// For more information:
		// http://en.wikipedia.org/wiki/Salt_%28cryptography%29
		// http://en.wikipedia.org/wiki/Brute-force_attack
		// http://en.wikipedia.org/wiki/Rainbow_table
		$salt = dechex ( mt_rand ( 0, 2147483647 ) ) . dechex ( mt_rand ( 0, 2147483647 ) );
		
		// This hashes the password with the salt so that it can be stored securely
		// in your database. The output of this next statement is a 64 byte hex
		// string representing the 32 byte sha256 hash of the password. The original
		// password cannot be recovered from the hash. For more information:
		// http://en.wikipedia.org/wiki/Cryptographic_hash_function
		$password = hash ( 'sha512', $_POST ['password'] . "-" . S_Pswd_Salt );
		
		// Here we prepare our tokens for insertion into the SQL query. We do not
		// store the original password; only the hashed version of it. We do store
		// the salt (in its plaintext form; this is not a security risk).
		$query_params = array (
				':password' => $password,
				':email' => $_POST ['email'],
				':first_name' => $_POST ['first_name'],
				':last_name' => $_POST ['last_name'],
				':username' => $_POST ['username'] 
		);
		
		try {
			// Execute the query to create the user
			$stmt = $db->prepare ( $query );
			$result = $stmt->execute ( $query_params );
		} catch ( PDOException $ex ) {
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die ( "Failed to run query: " . $ex->getMessage () );
		}
		
		// This redirects the user back to the clogin page after they register
		header ( "Location: login.php" );
		
		// Calling die or exit after performing a redirect using the header function
		// is critical. The rest of your PHP script will continue to execute and
		// will be sent to the user if you do not die or exit.
		die ( "Redirecting to login.php" );
	}
}	
	
$view = new viewServer();
	
$view->first_name = $first_name;
$view->last_name = $last_name;
$view->email = $email;
$view->username = $username;
$view->url = $_SESSION ['previous_page'];

$view->render("register.phtml");
?>
