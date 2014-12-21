<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("viewServer.php");
 	
$view = new viewServer();

$view->render("index.phtml");
?>
