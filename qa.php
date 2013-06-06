<?php
require_once('db.php');
require_once('header.php');
$author_id = $_REQUEST['author_id'];



// retrieve form data, hit Sherpa API
// ISSN trumps all, previously entered journal trumps search terms box
if(!empty($_POST['issn']))
	{
	    $issn = $_POST['issn'];	    
	    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?issn=' . $issn . '&ak=xZXLRaguUXs';	    
	    $encoded_url = urlencode($url);	    
	    $obj = simplexml_load_file($encoded_url);	    	    
	}

//previously entered journal title provided...
else if(!empty($_POST['prev_issn']))
	{		
	     $issn = $_POST['prev_issn'];	       
	    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?issn=' . $issn . '&ak=xZXLRaguUXs';	  	    
	    $encoded_url = urlencode($url);	    
	    $obj = simplexml_load_file($encoded_url);	    	    
	}

//journal title provided...
else if(!empty($_POST['jtitle']))
	{		
	    $jtitle = $_POST['jtitle'];	    
	    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?jtitle=' . $jtitle . '&ak=xZXLRaguUXs&qtype=exact';	    
	    $encoded_url = urlencode($url);	    
	    $obj = simplexml_load_file($encoded_url);	    	    
	}

//determine if journal found
$outcome = $obj->header->outcome;
if ($outcome != 'notFound') {

	//parse XML for information and permissions
	$jtitle = $obj->journals->journal->jtitle;
	$publisher = $obj->journals->journal->romeopub;
	$conditions = $obj->publishers->publisher->conditions; //array of "condition"
	$preprint = $obj->publishers->publisher->preprints->prearchiving;
	$preprint_restrictions = $obj->publishers->publisher->preprints->prerestrictions; //array of "prerestrction"
	$postprint = $obj->publishers->publisher->postprints->postarchiving;
	$postprint_restrictions = $obj->publishers->publisher->postprints->postrestrictions; //array of "postrestrction"
	//get issn if not provided by user
	$issn = $obj->journals->journal->issn;
	?>

	<div id="page_content">
		<?php		
			echo "<b>Journal Title:</b> <a href='http://www.sherpa.ac.uk/romeo/search.php?issn=$issn'>$jtitle</a></br>";
			echo "<b>ISSN:</b> $issn</br>";
			echo "<b>Publisher:</b> $publisher</br>";
			echo "<b>Preprint:</b> $preprint</br>";
			if (sizeof($preprint_restrictions->prerestriction) > 0) {
				echo "<ul>";
				foreach ($preprint_restrictions->prerestriction as $pre) {				
					echo "<li>$pre</li>";
				}
				echo "</ul>";
			}
			echo "<b>Postprint:</b> $postprint</br>";
			if (sizeof($postprint_restrictions->postrestriction) > 0) {
				echo "<ul>";
				foreach ($postprint_restrictions->postrestriction as $post) {				
					echo "<li>$post</li>";
				}
				echo "</ul>";
			}
			echo "<b>Conditions:</b></br>";
			if (sizeof($conditions->condition) > 0) {
				echo "<ul>";			
				foreach ($conditions->condition as $condition) {				
					echo "<li>$condition</li>";
				}
				echo "</ul>";
			}
			echo "<ul>";
			echo "</ul>";

			echo "<b>Citations to add under this journal:</b>";
			echo "<div id='citation_text_box'>";
			echo $_POST['citation_text'];
			echo "</div>";

			//create param_array for citations db entry
			$citation_info = array(
									'author_id' => $author_id,
									'citation_text' => $_POST['citation_text'],
									'jtitle' => $jtitle->asXML(),
									'issn' => $issn->asXML(),
									'preprint' => $preprint->asXML(),
									'postprint' => $postprint->asXML(),
									'conditions' => $conditions->asXML(),
									'post_restrictions' => $postprint_restrictions->asXML(),
									'pre_restrictions' => $preprint_restrictions->asXML(),
									);
			// Testing
			// print_r($citation_info);

			//cookie
			$srz_citation_info = serialize($citation_info);
			setcookie("citation_info", $srz_citation_info);		

		?>		
		</br></br></br>
		<div id="report_decision">		
			<p><b>Select a report section to add citations to, or go back:</b></br>
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=publisher'">Add to Publisher</button>
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=postprint'">Add to PostPrints</button>			
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=preprint'">Add to PrePrints</button>				
				<button class="btn btn-small" onClick="javascript:history.back();">Go Back</button>
			</p>
		</div>
	<?php } //closes != notFound conditional

else {
	echo "<div id='page_content'>";
	echo "The journal was not be found, <a href='javascript:history.back();'>try again.</a>";
} ?>

	</div> <!-- closes page_content div -->

<?php
require_once('footer.php');
?>