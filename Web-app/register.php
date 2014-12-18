<?php

// Code provided from:
// http://forums.devshed.com/php-faqs-and-stickies-167/how-to-program-a-basic-but-secure-login-system-using-891201.html

// Toss: Should insert this code into a tempate .html page
// Toss: I have removed code related to username, since we aren't using those

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("validation.php");

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
				SELECT
					1
				FROM User
				WHERE
					Username = :username
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
				SELECT 
					1 
				FROM User 
				WHERE 
					Email = :email 
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

?>

<head>
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
	$(function() {
   $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1920:2014",
    });
   $( "#datepicker" ).datepicker( "option", "showAnim", "show" );
  });
  	</script>
</head>
<!--Header-->
<?php

$_SESSION ['title'] = "Sign Up";
include_once ("templates/header.php");
$error = $_SESSION ['error'];

?>
<!-- HOME PAGE BLOCK -->
<div class="line">
	<div class="s-18 l-12">
		<h1>Sign up</h1>
		<div class="box">
			<form name="signup" action="register.php" method="post"
				class="customform s-18 l-8">
				<span class="signupError">
				<?php if (isset($error['message'])) {echo $error['message'];} ?></span>

				<div class="s-9">
					<span class="signupError">
					<?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
					First Name<span class="signupError">
				<?php if (isset($error['names'])) {echo $error['names'];} ?></span>
					<input type="text" name="first_name" value="<?php echo $first_name; ?>" />
				</div>

				<div class="s-9">
					<span class="signupError">
					<?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
					Last Name<span class="signupError">
					<?php if (isset($error['names'])) {echo $error['names'];} ?></span>
					<input type="text" name="last_name" value="<?php echo $last_name; ?>" />
				</div>

				<div class="s-9">
					<span class="signupError">
					<?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
					Email<span class="signupError">
					<?php if (isset($error['email'])) {echo $error['email'];} ?></span>
					<input type="text" name="email" value="<?php echo $email; ?>" />
				</div>

				<div class="s-9">
					<span class="signupError">
					<?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
					Password<span class="signupError">
					<?php if (isset($error['password'])) {echo $error['password'];} ?></span>
					<input type="password" name="password" value="" />
				</div>

				<div class="s-9">
					Confirm Password<span class="signupError">
					<?php if (isset($error['confirm_password'])) {echo $error['confirm_password'];} ?></span>
					<input type="password" name="confirm_password" value="" />
				</div>

				<div class="s-9">
					<span class="signupError">
					<?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
					Username<span class="signupError">
					<?php if (isset($error['username'])) {echo $error['username'];} ?></span>
					<input type="text" name="username" value="<?php echo $username; ?>" />
				</div>

				<br />
				<div class="s-9">
					<input type="checkbox" name="Terms" value="checked"> I have read
					and accept the Terms and Conditions <span class="signupError">
					<?php if (isset($error['icon2'])) {echo $error['icon2'];} ?></span>
				</div>
				<div class="s-9">
					<button type="submit">Sign up</button>
				</div>
			</form>
		</div>
	</div>
</div>
<br />

<!--Footer-->
<?php
include_once ("templates/footer.php");
?>
