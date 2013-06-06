<?php

require_once('db.php');
require_once('header.php');


if ( isset($_POST['author_name']) ) {
	$author_name = $_POST['author_name'];	
	$query = "INSERT INTO person SET 
		name = '{$author_name}'";	
	// Insert form data
	if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }
	echo "<span style='color:green;'>Author '$author_name' successfully created.</span></br>";
	echo "<a href='index.php'>Return to Author selection screen...</a>";
}

else {

?>
<div id="page_content">

	<p>Create a new author / project:</p>
	<form id="author_create" name="author_create" action="author_create.php" method="POST">
		<label>Author Name</label>
		<input id="author_name" name="author_name" type="text">
		<input type="submit" value="create" />		
	</form>
</div>

<?php
} //closes else
require_once('footer.php');
?>