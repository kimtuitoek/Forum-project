<?php 

  // First we execute our common code to connection to the database and start the session 
  require("common.php");
  
  //Store previoue page location incase of new post
  $_SESSION['previous_page'] = $_SERVER['PHP_SELF']."?id=".$_GET['id']."&obj=".$_GET['obj'];

  if(!empty($_GET))
  {
  //Query to select threads and topics
  $query = "SELECT * FROM Post as p JOIN User as u on p.User_id = u.User_id JOIN Thread as t on t.Thread_id = p.Thread_id Where t.Thread_id = :thread_id or t.Object_id = :obj";

  $query_params = array( 
      ':thread_id' => $_GET['id'],
      ':obj' => $_GET['obj']);

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

  $rows = $stmt->fetchAll();
  
  //Update views count
  $query2 = "UPDATE Thread SET Views = :views WHERE Thread_id = :t_id";
  $query_params2 = array(':t_id' => $_GET['id'], ':views' => $_GET['views'] + 1);

   try 
  { 
    // Execute the query against the database 
    $stmt = $db->prepare($query2); 
    $result = $stmt->execute($query_params2);  
  } 
  catch(PDOException $ex) 
  { 
    die("Failed to run query: " . $ex->getMessage()); 
  } 

  }

   include("header.php");
?>


      <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
        <div class="box">
          <div class="margin">
            <!-- CONTENT -->
            <section class="s-12 l-9 right">
              <?php foreach ($rows as $row) {?>
                <table class="responstable">
                  <tr>
                    <th >User: <?php echo($row['Username']);?> </th>
                  </tr>
                  
                  <tr> <td><?php echo($row['Body'] ."\t"); ?> </td></tr>

                  <tr> <td><?php if($row['User_id'] == $_SESSION['user']['User_id']) { ?>
                    <a href="edit-post.php?p_id=<?php echo($row['Post_id']);?>&t_id=<?php echo($row['Thread_id']);?>">Edit</a>
                      </td>
                  <?php } ?>
                  </tr>
                </table> 
                <br/><br/>  
               <?php }?>

              <!--Add new post-->
               <form action="newpost.php" method="post" class="customform s-12 l-8">
               <p>New Post:</p>
               <textarea name="text_post"style="width: 808px; height: 121px;"></textarea>
               <input type="hidden" name="thread_id" value="<?php echo($_GET['id']);?>">
               <div class="s-9" ><button type="submit">Post</button></div>
             </form>

             </div>
            </section>
<!-- FOOTER -->
<?php  include("footer.php");
?>
