<?php
	require("common.php");
	
	$query = "SELECT * FROM Thread WHERE Name LIKE :qVals";
   	$search =  $_GET['q']."%";
   	$query_params = array('qVals' => $search);
	 
    try 
    { 
      // Execute the query against the database 
      $stmt = $db->prepare($query); 
      $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
      die("Failed to run query: " . $ex->getMessage()); 
    } 

    $rows = $stmt->fetchAll();
    if($_GET['q'] != "")
    {
?>

<!-- Display content in the search area -->
<?php foreach($rows as $row): ?> 
      <div id="custom_search">
        <li class = "custom_list">
          <a href="posts.php?id=<?php echo($row['Thread_id'])?>&obj=<?php echo($row['Object_id'])?>&views=<?php echo($row['Views'])?>">
        <?php echo $row['Name']." (".$row['Type'].")";?> </a>
        </li><br/>
      </div>
<?php endforeach; }?>