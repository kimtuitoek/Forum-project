<?php 

// First we execute our common code to connection to the database and start the session 
require("common.php");
require ("viewServer.php");
  
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] . "?q=" . $_GET['q'];

$topic = 1;
  
// Query to select threads and topics
$query = "	SELECT	*, 
					t1.Status as thread_status, 
					t1.Post_count as Post_count 
			FROM	Thread as t1 JOIN User as u on t1.User_id = u.User_id 
			WHERE	Name LIKE :qVals";;
$search =  $_GET['q']."%";
$query_params = array('qVals' => $search);

// Query to select topics
$query2 = "	SELECT	*
			FROM	Topic LEFT JOIN Topic_relation on Topic_id = Child_topic_id";

try 
{ 
	// Execute the query against the database 
	$stmt = $db->prepare($query); 
	$stmt->execute($query_params);
	
	$rows = $stmt->fetchAll ();
	
	$stmt = $db->prepare ( $query2 );
	$stmt->execute ();
	
	$topics = $stmt->fetchAll ();
	} 
 
catch(PDOException $ex) 
	{ 
		die("Failed to run query: " . $ex->getMessage()); 
	}

$view = new viewServer();

$view->rows = $rows;
$view->topics = $topics;
$view->topic = $topic;

$view->render("search.phtml");

?>
  