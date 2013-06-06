<?php
require_once('db.php');
require_once('header.php');


$citation_edit = $_POST['citation_edit'];
$cite_num = $_POST['cite_num'];
$author_id = $_POST['author_id'];

//db insert
$query = "UPDATE citations SET citation = '$citation_edit' WHERE id = '$cite_num'";

if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }

else {
	?>
	<div id="page_content">
		<?php
			echo "Citation(s) changed.</br></br>";
			echo "<a href='report.php?author_id=$author_id'>Back to Report</a></br>";
	?></div><?php

}

//footer
require_once('footer.php');
?>