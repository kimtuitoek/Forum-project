<?php 

  // First we execute our common code to connection to the database and start the session 
  require("common.php");
  
  //Query to select threads and topics
  $query = "SELECT * FROM Thread as t1 JOIN User as u on t1.User_id = u.User_id";

  try 
  { 
    // Execute the query against the database 
    $stmt = $db->prepare($query); 
    $stmt->execute();
  } 
  
  catch(PDOException $ex) 
  { 
    die("Failed to run query: " . $ex->getMessage()); 
  } 

  $rows = $stmt->fetchAll();

  include("header.php");
?>
    
      <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
        <div class="box">
          <div class="margin">
          <!-- CONTENT -->
            <section class="s-12 l-9 right">
              <h1>Threads</h1>
                  <div class="margin">
                    <table class="responstable">
  
  <tr>
    <th>Name</th>
    <th>Number of posts</th>
    <th>Views</th>
    <th>Date of creation</th>
    <th>Owner</th>
    <th>Options</th>
  </tr>
  
  <?php
  foreach ($rows as $row) { ?>
  <tr>
    <td><a href="posts.php?id=<?php echo($row['Thread_id'])?>&obj=<?php echo($row['Object_id'])?>&views=<?php echo($row['Views'])?>">
        <?php echo $row['Name']." (".$row['Type'].")";?> </a></td>
    <td> <?php echo $row['Post_count']; ?></td>
    <td> <?php echo $row['Views']; ?> </td>
    <td> <?php echo $row['Date']; ?> </td>
    <td> <?php echo $row['Username']; ?> </td>
    <td><a>Rename</a><br/> <a>Lock</a><br/> <a>Delete</a></td>
  </tr>
  <?php  }?>
  
</table>
        <!--New thread button-->
        <a class="Button" href="newthread.php">New thread</a>

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
<?php  include("footer.php");
?>