<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// Including the DB connection file:
require_once('pdo_connect.php');
						
$query = "SELECT * FROM collection ORDER BY id DESC";

$result_set = executeQuery($query);
$count = $result_set['affected_rows'];
$result_set = $result_set['rows'];

$notes = '';
$left='';
$top='';
$zindex='';

foreach ($result_set as $key) {
	$collections.= '
	<div class="collection">
		<li><div class="collection_name"><a href="collection?id='.$key['id'].'" >'.htmlspecialchars($key['name']).'</a></div></li>
	</div>'
	;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Sticky Notes</title>

	<link rel="stylesheet" type="text/css" href="styles.css" />
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />

	<script src="jquery/jquery.min.js"></script>
	<script src="jquery/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>
	
	<script type="text/javascript" src="script.js"></script>
</head>

<body>
	<div id="collections">	
	
		<a id="addCollection" class="addCollection" href="add_collection.html">NEW COLLECTION</a>
		<h1>Collections </h1	>
		<div id="collection_list">		
			<ul>
				<?php echo $collections?>
			</ul>
		</div>
	</div>
</body>
</html>
