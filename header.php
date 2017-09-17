<?php 
	include_once("config.php");
	header('Content-Type: text/html; charset=utf-8');
 
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset='utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="inc/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="inc/jquery-1.4.2.min.js"></script> 
	<script type="text/javascript" src="inc/jquery-ui-1.8.2.custom.min.js"></script>
	
	<?php doCSS(); ?>
</head>
<body>

<?php 
include('menu.php');
?>