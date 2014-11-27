<?php 

	// First we execute our common code to connection to the database and start the session 
	require("common.php"); 
	 
	// This variable will be used to re-display the user's username to them in the 
	// login form if they fail to enter the correct password.  It is initialized here 
	// to an empty value, which will be shown if the user has not submitted the form. 
	$submitted_email = ''; 
	$login_error = "";
	// This if statement checks to determine whether the login form has been submitted 
	// If it has, then the login code is run, otherwise the form is displayed 
	if(!empty($_POST)) 
	{ 
		// This query retreives the user's information from the database using 
		// their username. 
		$query = " 
			SELECT 
				*
			FROM User
			WHERE 
				Email = :Email 
		"; 
		 
		// The parameter values 
		$query_params = array( 
			':Email' => $_POST['Email'] 
		); 
		 
		try 
		{ 
			// Execute the query against the database 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params); 
		} 
		catch(PDOException $ex) 
		{ 
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		} 
		 
		// This variable tells us whether the user has successfully logged in or not. 
		// We initialize it to false, assuming they have not. 
		// If we determine that they have entered the right details, then we switch it to true. 
		$login_ok = false; 
		 
		// Retrieve the user data from the database.  If $row is false, then the username 
		// they entered is not registered. 
		$row = $stmt->fetch(); 
		if($row) 
		{ 
			// Using the password submitted by the user and the salt stored in the database, 
			// we now check to see whether the passwords match by hashing the submitted password 
			// and comparing it to the hashed version already stored in the database. 
			$check_password = hash('sha512', $_POST['password']."-".S_Pswd_Salt);
			 
			if($check_password === $row['Password']) 
			{ 
				// If they do, then we flip this to true 
				$login_ok = true; 
			} 

		} 
		 
		// If the user logged in successfully, then we send them to the private members-only page 
		// Otherwise, we display a login failed message and show the login form again 
		if($login_ok) 
		{ 
			// Here I am preparing to store the $row array into the $_SESSION by 
			// removing the salt and password values from it.  Although $_SESSION is 
			// stored on the server-side, there is no reason to store sensitive values 
			// in it unless you have to.  Thus, it is best practice to remove these 
			// sensitive values first. 
			// unset($row['salt']); 
			unset($row['password']); 
			 
			// This stores the user's data into the session at the index 'user'. 
			// We will check this index on the private members-only page to determine whether 
			// or not the user is logged in.  We can also use it to retrieve 
			// the user's details. 
			$_SESSION['user'] = $row;

			
			// Redirect the user to the private members-only page. 
			if(isset($_SESSION['previous_page']))
			{
				header("Location: ". $_SESSION['previous_page']); 
				die("Redirecting to: ". $_SESSION['previous_page']);
			}
			else
			{
				header("Location: index.php"); 
				die("Redirecting to: index.php");
			}
		} 
		else 
		{ 
			// Tell the user they failed 
			$login_error = "Incorrect email / password";
			// Show them their username again so all they have to do is enter a new 
			// password.  The use of htmlentities prevents XSS attacks.  You should 
			// always use htmlentities on user submitted values before displaying them 
			// to any users (including the user that submitted them).  For more information: 
			// http://en.wikipedia.org/wiki/XSS_attack 
			$submitted_email = htmlentities($_POST['Email'], ENT_QUOTES, 'UTF-8'); 
		} 
	} 
	 
?> 

<!DOCTYPE html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=device-width" />
  <title>Responsive Business template</title>
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/responsee.css">  
  <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="owl-carousel/owl.theme.css">
  <link href="css/custom.css" rel="stylesheet">
 
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/responsee.js"></script>
  <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
  
  
   <script type="text/javascript">
    $(document).ready(function() {     
    $("#owl-demo").owlCarousel({     
    navigation : true,
    slideSpeed : 300,
    paginationSpeed : 400,
    autoPlay : true,
    singleItem:true
    });
    });  
    
    $(document).ready(function() {     
    $("#owl-demo2").owlCarousel({
    items : 4,
    lazyLoad : true,
    autoPlay : true,
    navigation : true,
    pagination : false
    });     
    });   
  </script>
   <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  </head>
  
<body class="size-960">
	<div class="customBorder" "s-12 l-8 right" "line" "box">
	<fieldset class="box">
		<h1>Login</h1> 
		<form action="login.php" method="post" class="customform s-12 l-8"> 
			<div class="s-9">Email:<input type="text"  name="Email" 
				value="<?php echo htmlentities($submitted_email, ENT_QUOTES, 'UTF-8'); ?>" /></div>
			<div class="s-9">Password:<input type="password"  name="password" value="" /></div>
			<div class="s-9" ><button type="submit">Login</button></div>
			<div class="loginError">
				<?php echo htmlentities($login_error, ENT_QUOTES, 'UTF-8'); ?></div>
			<div class="s-9" ><input type="checkbox" name="Remember" value="Remember">Remember me</div>
		</form> 
	<a href="register.php" class="s-9" >Sign up</a>
	</fieldset>
	</div>
</body>
