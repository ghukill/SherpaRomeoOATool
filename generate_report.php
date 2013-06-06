<?php
require_once('db.php');
require_once('header.php');

$author_name = getAuthorName($author_id);
$pdf_author_name = str_replace(" ", "_", $author_name); 

?>
 	<div id="page_content">
 		<?php
			echo "<p>Report Generated for $author_name. <a href='pdfs/$pdf_author_name.pdf'>View PDF</a></p>";
			echo "<a href='report.php?author_id=$author_id'>Back to Report</a></br>";
?></div><?php


//footer
require_once('footer.php');

// write pdf report
$cmd_string = "python ./write_report.py $author_id '$author_name'";
exec($cmd_string);

?>