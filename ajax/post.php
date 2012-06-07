<?php

// Error reporting
error_reporting(E_ALL^E_NOTICE);

require_once("../pdo_connect.php");


/* Inserting a new record in the notes DB: */
if($_POST['submit'] == 'note-submit'){
	$in_query = " INSERT INTO notes (text, name, color, xyz)
				VALUES (:body, :author, :color, :zindex)
	";
	$in_binds = array(':body' => $_POST['body'],':author' => $_POST['author'],':color' => $_POST['color'],':zindex' => '0x0x'.$_POST['zindex']);

}else{
	$in_query = " UPDATE notes 
				SET text = :body
				WHERE id= :id
	";
	$in_binds = array(':body' => $_POST['body'], ':id' => $_POST['id']);
	
}


				

$in_result = executeQuery($in_query, $in_binds);

if($in_result['affected_rows'] == 1)
{
	// Return the id of the inserted row:
	echo $in_result['insert_id'];
	
}
else echo '0';

?>
