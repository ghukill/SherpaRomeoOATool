<?php

// ajax call for keyword contains
// parse out jtitle(s)
// return json

if(!empty($_GET['keywords'])) {
	$keywords = $_GET['keywords'];
	// echo $keywords;
}

$url = 'http://www.sherpa.ac.uk/romeo/api29.php?jtitle=' . $keywords . '&qtype=contains&ak=xZXLRaguUXs';
// echo $url;
$encoded_url = urlencode($url);
$obj = simplexml_load_file($encoded_url);

echo "<ul>";
// loop through and get journal titles
foreach ($obj->journals->journal as $journal) {
    $jtitle = $journal->jtitle;
    $issn = $journal->issn;    
    echo "<li><a id='$jtitle' issn='$issn' href='#' onclick='selectSugg(this.id);'>$jtitle / $issn</a></li>";
}
echo "</ul>";

?>
