<!DOCTYPE html>

<?php 

  // First we execute our common code to connection to the database and start the session 
  require("common.php");
  
    $query = "SELECT * FROM User";

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

  foreach ($rows as $row) { 
      die($row['First_name']); 
    }

  ?>