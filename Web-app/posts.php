<?php

// First we execute our common code to connection to the database and start the session
require ("common.php");
require ("utilities.php");

$_SESSION ['previous_previous_page'] = $_SESSION ['previous_page'];
$_SESSION ['previous_page'] = $_SERVER ['PHP_SELF'] . "?id=" . $_GET ['id'] . "&obj=" . $_GET ['obj'] . "&views=" . $_GET ['views'] . "&posts=" . $_GET['posts'];

if (! empty ( $_GET )) {
	// Query to select threads and topics
	$query = "SELECT *, u.User_id as User_id, p.Object_id as Object_id FROM Post as p JOIN User as u on p.User_id = u.User_id JOIN Thread as t on t.Thread_id = p.Thread_id Where t.Thread_id = :thread_id or t.Object_id = :obj";
	
	$query_params = array (
			':thread_id' => $_GET ['id'],
			':obj' => $_GET ['obj'] 
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query );
		$result = $stmt->execute ( $query_params );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$rows = $stmt->fetchAll ();
	
	// Update views count
	$query2 = "UPDATE Thread SET Views = :newviews  WHERE Thread_id = :thread_id";
	$query_params2 = array (
			':thread_id' => $_GET ['id'],
			':newviews' => $_GET ['views'] + 1
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query2 );
		$result = $stmt->execute ( $query_params2 );
	} catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	// Query to get thread status
	$query3 = "SELECT Status, User_id, Object_id, Name FROM Thread as t WHERE t.Thread_id = :thread_id";
	$query_params3 = array (
			':thread_id' => $_GET ['id']
	);
	
	try {
		// Execute the query against the database
		$stmt = $db->prepare ( $query3 );
		$stmt->execute ( $query_params3 );
		$result3 = $stmt->fetch();
	}
	
	catch ( PDOException $ex ) {
		die ( "Failed to run query: " . $ex->getMessage () );
	}
	
	$thread_info =$result3;
}

	$thread_id = 0;
include ("templates/header.php");
?>

<!-- ASIDE NAV AND CONTENT -->
<div class="line">
	<div class="box">
		<div class="margin">
			<!-- CONTENT -->
			<section class="s-12 l-9 right">
					<h1><?php echo($thread_info['Name'])?></h1>
					<?php foreach ($rows as $row) :?>
					<table class="responstable">
						<tr> <th>Posted by <?php echo($row['Username']);?> </th> </tr>
						<tr> <td style="height:100px;"><?php echo($row['Body'] ."\t"); ?> </td> </tr>
						<tr>
							<td>
								<a style="font-size: 75%"> Posted on: <?php echo($row['Date']);?> </a>
								<?php if (!isset($_SESSION['user']['Priviledge'])) : ?>
								<?php elseif ($row['User_id'] == $_SESSION ['user']['User_id'] and $_SESSION ['user']['Priviledge'] <> '0') :?>
									<a	href="edit-post.php?p_id=<?php echo($row['Post_id']);?>&t_id=<?php echo($row['Thread_id']);?>" style="font-size: 75%; float:right" >Edit</a>
									<a  style="font-size: 75%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
									<a	href="delete.php?obj=<?php echo($row['Object_id']);?>" style="font-size: 75%; float:right" >Delete</a>
								<?php elseif ($row['User_id'] <> $_SESSION ['user']['User_id'] and $_SESSION ['user']['Priviledge'] <> '0') :?>
									<a	href="edit-post.php?p_id=<?php echo($row['Post_id']);?>&t_id=<?php echo($row['Thread_id']);?>" style="font-size: 75%; float:right" >Edit</a>
									<a  style="font-size: 75%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
									<a	href="delete.php?obj=<?php echo($row['Object_id']);?>" style="font-size: 75%; float:right" >Delete</a>
									<a  style="font-size: 75%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
									<a	href="report.php?obj=<?php echo($row['Object_id']);?>" style="font-size: 75%; float:right" >Report</a>
								<?php elseif ($row['User_id'] == $_SESSION ['user']['User_id'] and $thread_info['Status'] !== '1') : ?>
									<a	href="edit-post.php?p_id=<?php echo($row['Post_id']);?>&t_id=<?php echo($row['Thread_id']);?>" style="font-size: 75%; float:right" >Edit</a>
								<?php elseif ($row['User_id'] <> $_SESSION ['user']['User_id'] and $thread_info['Status'] !== '1') :?>
									<a	href="report.php?obj=<?php echo($row['Object_id']);?>" style="font-size: 75%; float:right" >Report</a>
								<?php endif?>
							</td>
						</tr>
					</table><br/>
					<?php endforeach;?>
					<?php if ($thread_info['User_id'] <> $_SESSION ['user']['User_id'] and $_SESSION['user']['Priviledge'] >= 1) :?>
						<a	href="report.php?obj=<?php echo($thread_info['Object_id']);?>" style="font-size: 80%; float:right" >Report Thread</a>
						<a  style="font-size: 80%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
					<?php elseif ($thread_info['User_id'] <> $_SESSION ['user']['User_id'] and $thread_info['Status'] !== '1') :?>
						<a	href="report.php?obj=<?php echo($thread_info['Object_id']);?>" style="font-size: 80%; float:right" >Report Thread</a>
					<?php endif ?>
					<?php if (!isset($_SESSION['user']['Priviledge'])) :?>
					<?php elseif ($_SESSION['user']['Priviledge'] >= 1) :?>
						<a href="delete.php?obj=<?php echo($thread_info['Object_id'])?>&db=<?php echo($thread_info['Object_id'])?>" style="font-size: 80%; float:right" >Delete</a>
						<?php if ($thread_info['Status'] == 1) :?>
							<a  style="font-size: 80%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
							<a href="ToggleLock.php?obj=<?php echo($thread_info['Object_id'])?>" style="font-size: 80%; float:right" >Unlock</a>
						<?php else :?>
							<a  style="font-size: 80%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
							<a href="ToggleLock.php?obj=<?php echo($thread_info['Object_id'])?>" style="font-size: 80%; float:right" >Lock</a> 
						<?php endif?>
						<a  style="font-size: 80%; float:right; color: #0099FF; margin-right: 4px; margin-left: 4px" >  -  </a>
						<a href="RenameThread.php?obj=<?php echo($thread_info['Object_id'])?>" style="font-size: 80%; float:right" >Rename</a> 
					<?php endif ?>
					<br />
					<br /> 
					<!-- Only show option to post if thread is not locked. Else show locked text.-->
					<?php if ($thread_info['Status'] !== '1') :?>
				
					<!--Add new post-->
					<form action="newpost.php?posts=<?php echo($_GET['posts']);?>&id=<?php echo($_GET['id']);?>&views=<?php echo($_GET['views']);?>" method="post" class="customform s-12 l-12">
           				<p>New Post:</p>
           				<textarea name="text_post"style=" height: 121px;"></textarea>
           				<input type="hidden" name="thread_id" value="<?php echo($_GET['id']);?>">
           				<input type="hidden" name="obj" value="<?php echo($_GET['obj']);?>">
           				<div class="s-9 l-2" ><button type="submit">Post</button></div>
           			</form>
					
					<!-- Show thread locked -->
					<?php else :?>
					<form method="post" class="customform s-12">
						<button class="customform s-2" type="submit">Thread Locked</button>
					</form>
					<?php endif?>
			</section>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php include ("templates/footer.php"); ?>
