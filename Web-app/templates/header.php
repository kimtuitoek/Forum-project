
<!DOCTYPE html>
<head>
<meta http-equiv="content-type"
	content="text/html; charset=windows-1250">
<meta name="viewport" content="width=device-width" />
<title>Responsive Online Store template</title>
<link rel="stylesheet" href="css/components.css">
<link rel="stylesheet" href="css/responsee.css">
<link href="css/custom.css" rel="stylesheet">

<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript"
	src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/responsee.js"></script>

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body class="size-1140">
	<!-- HEADER -->
	<header>
		<div class="line" align="right">
			<div class="top-nav s-12 1-10" id="top_navi">
				<ul>   
        <?php
								if (empty ( $_SESSION ['user'] )) {
									?>
          <li><a href='login.php'>Customer Login </a></li>
					<li><a href='register.php'> Sign up</a></li>
          <?php
								} else {
									?>
          <li id="welcome"><a>Welcome, <?php echo htmlentities($_SESSION['user']['First_name'], ENT_QUOTES, 'UTF-8')?></a></li>
					<li><a href='settings.php'>MyAccount</a></li>
					<li><a href='logout.php'>Logout</a></li>
        <?php }?>
        </ul>
			</div>
		</div>

		<div class="line">
			<div class="box">
				<div class="s-6 l-2">
					<img src="img/logo.png">
				</div>
				<div class="s-12 l-8 right">
					<div class="margin">
						<form class="customform s-12 l-8" action="http://google.com/">
							<div class="s-9">
								<input type="text" value="Search form" title="Search form" />
							</div>
							<div class="s-3">
								<button type="submit">Search</button>
							</div>
						</form>
						<div class="s-12 l-4"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- TOP NAV -->
		<div class="line">
			<nav>
				<p class="nav-text">Custom menu text</p>
				<div class="top-nav s-12 l-10">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="threads.php">Forums</a></li>
					</ul>
				</div>
				<div class=" hide-s l-2">
					<i class="icon-facebook_circle icon2x right padding"></i>
				</div>
			</nav>
		</div>
	</header>