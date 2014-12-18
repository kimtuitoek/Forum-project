<?php
// Validation variables and error array (NOTE: names is for both first and last names)
$error = array (
		'password' => "",
		'confirm_password' => "",
		'email' => "",
		'address' => "",
		'city' => "",
		'phone' => "",
		'postal_code' => "",
		'icon' => "",
		'icon2' => "",
		'message' => "",
		'names' => "",
		'user_type' => "" 
);

// Remains true if validation has passed
$validation_passed = True;

// POST variables
$first_name = "";
$last_name = "";
$email = "";
$address = "";
$city = "";
$postal_code = "";
$phone = "";
$user_type = "";
$password = "";
$confirm_password = "";

// Session array contains all errors generated from the validate function
$_SESSION ['error'] = $error;
$_SESSION ['validation_passed'] = $validation_passed;
function validate($array_Post) {
	$validation_passed = True;
	// Initialize post variables
	$first_name = array_key_exists ( 'first_name', $array_Post );
	$last_name = array_key_exists ( 'last_name', $array_Post );
	$email = array_key_exists ( 'email', $array_Post );
	$password = array_key_exists ( 'password', $array_Post );
	$confirm_password = array_key_exists ( 'confirm_password', $array_Post );
	$address = array_key_exists ( 'address', $array_Post );
	$city = array_key_exists ( 'city', $array_Post );
	$postal_code = array_key_exists ( 'postal_code', $array_Post );
	$phone = array_key_exists ( 'phone', $array_Post );
	$user_type = array_key_exists ( 'user_type', $array_Post );
	$Terms = array_key_exists ( 'Terms', $array_Post );
	
	if (! ($password == False)) {
		$password = $array_Post ['password'];
		
		// Ensure that the user has entered a non-empty password
		if (empty ( $array_Post ['password'] )) {
			// Note that die() is generally a terrible way of handling user errors
			// like this. It is much better to display the error with the form
			// and allow the user to correct their mistake. However, that is an
			// exercise for you to implement yourself.
			
			// Toss: Should totally figure out how to do this...
			$error ['password'] = "Please enter a password";
			$error ['icon'] = "(*)";
			$error ['icon2'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$validation_passed = False;
		} 

		else if (! ($confirm_password == False)) {
			$confirm_password = $array_Post ['confirm_password'];
			// Check whether confirmed password and entered password are the same
			if ($array_Post ['password'] != $array_Post ['confirm_password']) {
				$error ['confirm_password'] = "Passwords do not match";
				$validation_passed = False;
			}
		}
	}
	
	// Name validation
	if (! ($first_name == False || $last_name == False)) {
		$first_name = $array_Post ['first_name'];
		$last_name = $array_Post ['last_name'];
		// Check whether First name or last name is empty
		if (empty ( $first_name ) || empty ( $last_name )) {
			$error ['icon'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$error ['names'] = "Please enter full names";
			$validation_passed = False;
		}
	}
	
	// Address validation
	if (! ($address == False)) {
		$address = $array_Post ['address'];
		// Check whether the address is empty
		if (empty ( $address )) {
			$error ['icon'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$error ['address'] = "Please enter an address";
			$validation_passed = False;
		}
	}
	
	// City Validation
	if (! ($city == False)) {
		$city = $array_Post ['city'];
		// Check whether the city is empty
		if (empty ( $city )) {
			$error ['icon'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$error ['city'] = "Please enter a city";
			$validation_passed = False;
		}
	}
	
	// Postal code validation
	if (! ($postal_code == False)) {
		$postal_code = $array_Post ['postal_code'];
		// Check whether the postal code is empty
		if (empty ( $postal_code )) {
			$error ['icon'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$error ['postal_code'] = "Please enter a postal code";
			$validation_passed = False;
		}
	}
	
	// Postal code validation
	if (! ($phone == False)) {
		$phone = $array_Post ['phone'];
		// Check whether the phone number is empty
		if (empty ( $phone )) {
			$error ['icon'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$error ['phone'] = "Please enter a phone number";
			$validation_passed = False;
		}
	}
	
	// Terms and conditions validation
	if (! ($Terms == False)) {
		// Check whether the Terms and Conditions have been read
		if ($array_Post ['Terms'] != "checked") {
			$error ['icon2'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$validation_passed = False;
		}
	}
	
	// Email validation
	if (! ($email == False)) {
		$email = $array_Post ['email'];
		// Check if email is empty
		if (empty ( $array_Post ['email'] )) {
			$error ['email'] = "Please enter an email";
			$error ['icon'] = "(*)";
			$error ['icon2'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$validation_passed = False;
		} 		

		// Make sure the user entered a valid email address
		else if (! filter_var ( $array_Post ['email'], FILTER_VALIDATE_EMAIL )) {
			$error ['email'] = "Invalid E-Mail Address";
			$error ['icon'] = "(*)";
			$error ['icon2'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$validation_passed = False;
		}
	}
	
	// User type validation
	// Email validation
	if (! ($user_type == False)) {
		$user_type = $array_Post ['user_type'];
		// Check if email is empty
		if (empty ( $array_Post ['email'] )) {
			$error ['user_type'] = "User type is required";
			$error ['icon'] = "(*)";
			$error ['icon2'] = "(*)";
			$error ['message'] = "Fields with (*) are important";
			$validation_passed = False;
		}
	}
	
	$_SESSION ['validation_passed'] = $validation_passed;
	$_SESSION ['error'] = $error;
	return $validation_passed;
}
?>