<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// Including the DB connection file:
require_once('pdo_connect.php');
						
$query = "SELECT * FROM notes ORDER BY id DESC";

$result_set = executeQuery($query);
$count = $result_set['affected_rows'];
$result_set = $result_set['rows'];

$notes = '';
$left='';
$top='';
$zindex='';

foreach ($result_set as $key) {
	
// The xyz column holds the position and z-index in the form 200x100x10:
	list($left,$top,$zindex) = explode('x',$key['xyz']);

	$notes.= '
	<div class="note '.$key['color'].'" style="left:'.$left.'px;top:'.$top.'px;z-index:'.$zindex.'">
		'.htmlspecialchars($key['text']).'
		<div class="author">'.htmlspecialchars($key['name']).'</div>
		<span class="data">'.$key['id'].'</span>
	</div>';
   
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sticky Notes</title>

<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>
 
<script type="text/javascript" src="script.js"></script>

</head>

<body>
	<script>
	$(function() {
		$( "#draggable" ).draggable();
		$( "#droppable" ).droppable({
			drop: function( event, ui ) {
				$( this )
					.addClass( "ui-state-highlight" )
					.find( "p" )
					.html( "TRASH" );
			}
		});
	});
	</script>


<div id="main">
	<a id="addButton" class="white" href="add_note.html">NEW</a>
    
	<?php echo $notes?>
	

<div id="droppable" class="ui-widget-header">
<p>Trash</p>
</div>    
</div>



</body>
</html>
