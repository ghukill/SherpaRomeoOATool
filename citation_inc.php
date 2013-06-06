<?php
require_once('db.php');
require_once('header.php');

//get citation info
$citation_info = unserialize($_COOKIE['citation_info']);

foreach ($citation_info as $key => $value) {
		  // $clean[$key] = filtered($value); //phasing out functions from "encoding.php"
			$clean[$key] = filter_var($value, FILTER_SANITIZE_STRING);
			}


//processing for db insert
$issn = strip_tags($citation_info['issn']);
$citation_text = trim($citation_info['citation_text']);

//selected permissions type for report
$perm_type = $_GET['perm_type'];

//db insert
$query = "INSERT INTO citations SET 
	person_id = '{$clean['author_id']}', 
	citation = '$citation_text',
	jtitle = '{$clean['jtitle']}',
	issn = '$issn',
	conditions = '{$clean['conditions']}',
	report_choice = '{$perm_type}',
	preprint = '{$clean['preprint']}',
	postprint = '{$clean['postprint']}',
	preprint_restrictions = '{$clean['pre_restrictions']}',
	postprint_restrictions = '{$clean['post_restrictions']}'
	";

if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }

else {
	?>
	<div id="page_content">
		<?php
			echo "Citations added.</br></br>";
			echo "<a href='citations.php?author_id={$clean['author_id']}'>Add another</a> / ";
			echo "<a href='report.php?author_id={$clean['author_id']}'>View Report</button></a></br>";
	?></div><?php

}

//footer
require_once('footer.php');
?>
