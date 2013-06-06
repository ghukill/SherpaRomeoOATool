<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/sherpatool.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>	

	<!-- kube stylesheet -->
	<link rel="stylesheet" type="text/css" href="css/kube101/css/kube.css" />
	<!-- local stylesheet -->
	<link rel="stylesheet" href="css/sherpatool.css" type="text/css">

	<!-- report specific CSS overrides -->
	<style type="text/css">
		body {
			/*background-color:white;*/
		}
	</style>
</head>

<?php 
if (!empty($_REQUEST['author_id'])) {
	
	//get author_id
	$author_id = $_REQUEST['author_id'];
}
else {
	$author_id = "null";
}
?>

<body>
	<div id="header">
		<div class="container row">			
			<div class="half">
				<img src="images/library_system_w_v2.png"/>
				<h3 style="margin-bottom:0px;">Self-Archiving Report for <?php echo getAuthorName($author_id); ?>'s</h3>
				<p style="margin-bottom:0px;"><em>Generated <?php echo date("l, F j, Y"); ?></em></p>				
			</div>			
		</div>		
	</div>
