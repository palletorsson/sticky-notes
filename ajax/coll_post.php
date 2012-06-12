<?php

// Error reporting
error_reporting(E_ALL^E_NOTICE);

require_once("../pdo_connect.php");


/* Inserting a new record in the notes DB: */
if(isset($_POST['submit'])){
	$in_query = " INSERT INTO collection (name)
				VALUES (:name)
	";
	$in_binds = array(':name' => $_POST['collection-name']);

}else if($_POST['action'] == 'delete'){
	$in_query = " DELETE FROM notes 
				  WHERE id= :id ";
	$in_binds = array(':id' => $_POST['id']);	
	
}else{
	$in_query = "UPDATE notes 
				SET text = :body, color = :color
				WHERE id= :id
	";
	$in_binds = array(':body' => $_POST['body'], ':id' => $_POST['id'],':color' => $_POST['color']);
	
}

$in_result = executeQuery($in_query, $in_binds);

if($in_result['affected_rows'] == 1)
{
	// Return the id of the inserted row:
	echo $in_result['insert_id'];
	
}
else echo '0';

?>
