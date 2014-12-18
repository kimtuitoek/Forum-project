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
        Object_id,
        Type
			) VALUES ( 
				:User_id,
				:Name,
        NOW(),
        :Object_id,
        :Type	
				)"; 

    $Object_id = sha1($_POST['thread_name'].date("h:i:sa"));

  	$query_params = array( 
      ':User_id' => $_SESSION['user']['User_id'],
      ':Name' => $_POST['thread_name'],
      ':Object_id' => $Object_id,
      ':Type' => $_POST['Type']);

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

  if(empty($_SESSION['user']))
  {
      $_SESSION['previous_page'] = "newthread.php";
      header("Location: login.php");
      die("Redirecting to: login.php");
  }

  include("header.php");
  ?>

  
      <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
        <div class="box">
          <div class="margin">
          <!-- CONTENT -->
            <section class="s-12 l-9 right">
              <h1>New thread</h1>
                  <div class="margin">
                    
        <!--Add new thread-->
        <form action="newthread.php" method="post" class="customform s-12 l-8">
          <p>Create new thread:</p>
               <div>Name: <input type="textbox" name="thread_name" value=""> 
                  Type: <select name="Type">
                          <option value="Public">Public</option>
                          <option value="Private">Private</option>
                        </select>
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
