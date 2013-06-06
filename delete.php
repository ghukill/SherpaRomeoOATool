<?php
require_once('db.php');
require_once('header.php');


$author_id = $_REQUEST['author_id'];
$citation_num = $_REQUEST['citation_num'];


//db delete
// WHERE (person_id = '$author_id' AND report_choice = 'publisher')"
$query = "DELETE FROM citations WHERE (person_id = '$author_id' AND id = '$citation_num')";

if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }

else {
	?>
	<div id="page_content">
		<?php
			echo "Citation deleted.</br></br>";
			echo "<a href='report.php?author_id=$author_id'>Return to Report</a>";			
	?></div><?php

}

//footer
require_once('footer.php');
?>
