<?php
require_once('db.php');
require_once('header.php');


// steps:
	//** duplicate three times for each section "publisher", "postprints", "preprints" **
	// get journal all journal titles for author
	// identify duplicates (issn)
	// merge citation text into first
	// remove the rest

// get journal all journal titles for author
// $jtitles = array();
// $query = "SELECT id, jtitle, issn FROM citations WHERE person_id = '$author_id'";
// $result = $selfarchive_dbconnect->query($query) or die($selfarchive_dbconnect->error.__LINE__);						
// if($result->num_rows > 0) {
// 	while($row = $result->fetch_assoc()) {

// 	}
// }
// else {
// 	echo 'No journals entered yet.';	
// }

// print_r($jtitles);


//db insert
// $query = "UPDATE citations SET citation = '$citation_edit' WHERE id = '$cite_num'";

// if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }

// else {
// 	?>
 	<div id="page_content">
 		<?php
			echo "All in due time...</br>";
// 			echo "Citation(s) changed.</br></br>";
			echo "<a href='report.php?author_id=$author_id'>Back to Report</a></br>";
// 	?></div><?php

// }

//footer
require_once('footer.php');
?>