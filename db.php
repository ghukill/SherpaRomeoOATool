<?php
# Type="MYSQL"
# HTTP="true"
$hostname_selfarchive = "127.0.0.1";
$database_selfarchive = "selfarchive";
$username_selfarchive = "sherpatool";
$password_selfarchive = "password";

$selfarchive_dbconnect = new mysqli("$hostname_selfarchive", "$username_selfarchive", "$password_selfarchive", "$database_selfarchive");

if ($selfarchive_dbconnect->connect_errno) {
    echo "Failed to connect to MySQL: " . $selfarchive_dbconnect->connect_error;
}

// get author name from person_id 
function getAuthorName($author_id) {
	global $selfarchive_dbconnect;
	$query = "SELECT name FROM person WHERE id = '$author_id'";
	$result = $selfarchive_dbconnect->query($query) or die($selfarchive_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				 $author_name = $row['name'];
				 return $author_name;
			}

		}
		else {
			echo '[PERSON NOT FOUND]';	
		}
}

// function committEdit($cite_num,$cite_text) {
// 	global $selfarchive_dbconnect;
// 	//db insert
// 	$query = "INSERT INTO citations WHERE id = SET 
// 		person_id = '{$clean['author_id']}', 
// 		citation = '$citation_text',
// 		jtitle = '{$clean['jtitle']}',
// 		issn = '$issn',
// 		conditions = '{$clean['conditions']}',
// 		report_choice = '{$perm_type}',
// 		preprint = '{$clean['preprint']}',
// 		postprint = '{$clean['postprint']}',
// 		preprint_restrictions = '{$clean['pre_restrictions']}',
// 		postprint_restrictions = '{$clean['post_restrictions']}'
// 		";

// 	if (!@$selfarchive_dbconnect->query($query)) {echo $query; die; }
// }

?>

