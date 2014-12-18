<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");

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
		
		header ( "Location: settings.php" );
		die ( "Redirecting to: settings.php" );
	}
}

include_once ("templates/header.php");
?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box margin-bottom">
		<div class="margin">
			<article class="customform s-12 l-8">
				<h1>Change Password</h1>
				<form action="PasswordEdit.php" method="post">
					<div class="PasswordError"><?php if (isset($error['message'])) {echo $error['message'];} ?></div>


					<div>
						<span class="PasswordError"><?php if (isset($error['icon'])) {echo $error['icon'];} ?></span>
						New Password<span class="signupError"><?php if (isset($error['password'])) {echo $error['password'];} ?></span>
						<input type="password" name="password" value="" />
					</div>

					<div>
						Confirm Password<span class="PasswordError"><?php if (isset($error['confirm'])) {echo $error['confirm'];} ?></span>
						<input type="password" name="confirm_password" value="" />
					</div>
					<br />

					<div>
						<button type="submit" class="s-3" style="margin-right: 30px">Change</button>
					</div>
					<button type="button" class="s-3"
						onClick="window.location.href='settings.php'"><b>Cancel</b></button>
					<br />
				</form>
			</article>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php

include_once ("templates/footer.php");
?>

