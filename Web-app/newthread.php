<?php 

  // First we execute our common code to connection to the database and start the session 
  require("common.php");

  if(!empty($_POST))
  {


  	//Query to select threads and topics
  	$query = "INSERT INTO Thread ( 
				User_id,
				Name,
        Date,
        Object_id
			) VALUES ( 
				:User_id,
				:Name,
        NOW(),
        :Object_id	
				)"; 

    $Object_id = sha1($_POST['thread_name']);
    
  	$query_params = array( 
      ':User_id' => $_SESSION['user']['User_id'],
      ':Name' => $_POST['thread_name'],
      'Object_id' => $Object_id);

  	try 
  { 
    // Execute the query against the database 
    $stmt = $db->prepare($query); 
    $result = $stmt->execute($query_params);  
  } 
  catch(PDOException $ex) 
  { 
    die("Failed to run query: " . $ex->getMessage()); 
  } 

  header("Location: posts.php?id=&obj=".$Object_id);
  die("Redirecting to: posts.php?id=&obj=".$Object_id);
  }

  ?>

  <!DOCTYPE html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=device-width" />
  <title>Responsive Online Store template</title>
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/responsee.css">
  
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/responsee.js"></script>
  
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  </head>
  <body class="size-1140">
    <!-- HEADER -->
    <header>
      <div class="line">
        <div class="box">
          <div class="s-6 l-2">
            <img src="img/logo.png">
          </div>
          <div class="s-12 l-8 right">
            <div class="margin">
              <form  class="customform s-12 l-8" action="http://google.com/">
                <div class="s-9"><input type="text" value="Search form" title="Search form"/></div>
                <div class="s-3"><button type="submit">Search</button></div>
              </form>
              <div class="s-12 l-4">
                
              </div>
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
      <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
        <div class="box">
          <div class="margin">
          <!-- CONTENT -->
            <section class="s-12 l-9 right">
              <h1>Threads</h1>
                  <div class="margin">
                    
        <!--Add new thread-->
        <form action="newthread.php" method="post" class="customform s-12 l-8">
          <p>Create new thread:</p>
               <div>Name: <input type="textbox" name="thread_name" value=""></div>
               <div class="s-9" ><button type="submit">Create</button></div>
        </form>

           </div>
            </section>
            <!-- ASIDE NAV -->
            <aside class="s-12 l-3">
              <h3>Filters</h3>
              <div class="aside-nav">
                <ul>
                  <li><a>Options</a></li>
                  <li><a>Filters</a>
                    <ul>
                      <li><a>Filter 1</a></li>
                      <li><a>Filter 2</a></li>
                      <li><a>Filter 3</a>
                        <ul>
                          <li><a>Filter 3-1</a></li>
                          <li><a>Filter 3-2</a></li>
                          <li><a>Filter 3-3</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a>Publishers</a>
                    <ul>
                      <li><a>About</a></li>
                      <li><a>Location</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </aside>
          </div>
        </div>  
      </div>
      <!-- FOOTER -->
      <footer class="line">
        <div class="s-12 l-6">
          <p>© 2013 Responsee, All Rights Reserved</p>
        </div>
        <div class="s-12 l-6">
          <p class="right">Design and coding by Responsee</p>
        </div>
      </footer>
  </body>
</html>
