<?php 
// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// Including the DB connection file:
require_once('pdo_connect.php');
						
$id_query = "SELECT * FROM notes WHERE id = :id";
$id_binds = array(':id' => $_GET['id']);

$result_set = executeQuery($id_query, $id_binds);
$count = $result_set['affected_rows'];
$result_set = $result_set['rows'];
//print_r($result_set);
?>


<h3 class="popupTitle">Edit note</h3>

<!-- The preview: -->
<div id="previewNote" class="note <?php echo $result_set[0]['color'];  ?>" style="left:0;top:65px;z-index:1">
	<div class="body"> <?php echo $result_set[0]['text'];  ?></div>
	<div class="author"> <?php echo $result_set[0]['name'];  ?></div>
	<span class="data"> <?php echo $result_set[0]['id'];  ?></span>
</div>

<div id="noteData"> <!-- Holds the form -->
<form action="" method="post" class="note-form">

	<label for="note-body">Edit note</label>
	<textarea name="note-body" id="note-body" class="pr-body" cols="30" rows="6"><?php echo $result_set[0]['text'];  ?> </textarea>

	<label for="note-name">Originally written by</label>
	<input type="text" name="note-name" id="note-name" class="pr-author" disabled="disabled" value="<?php echo $result_set[0]['name'];  ?>" />

	<label>Color</label> <!-- Clicking one of the divs changes the color of the preview -->
	<div class="color yellow"></div>
	<div class="color blue"></div>
	<div class="color green"></div>

	<!-- The green submit button: -->

	<a id="edit-submit" name="<?php echo $result_set[0]['id'];  ?>" href="" class="green-button">Submit</a>

</form>
</div>
