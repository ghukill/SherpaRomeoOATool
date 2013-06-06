<?php
require_once('db.php');
require_once('header.php');

if (!empty($_REQUEST['author_id'])) {
	
	//get author_id
	$author_id = $_REQUEST['author_id'];
	?>

	<div id="page_content">
		<p>In this screen, cut and paste citations into the text box below for a given journal.  On the next screen, based on self-archiving permission provided by the Sherpa Romeo API, assign them to "Publisher Veresion / PDF", "Post-Print", and "Pre-Print" permissive status.</p>	
		<hr>
		<form id="citation_create" class="forms" name="citation_create" action="qa.php" method="POST">			
			<ul>
				<li>
					<label><b><span class="green">ISSN #</span> (overrides journal title entry below)</b></label>
					<input id="issn" name="issn" type="text">
				</li>		
				</br>			
				<li>
					<label class="green"><b>Journal Title Entry</b></label>
					<table class="simple tableforms width-100">
						<tbody>
							<tr class="labels">
								<td class="width-50">Enter Journal Title keywords: <a class="small" href="#" onclick="alert('tips for searching...');">(?)</a></td>
								<td class="width-50">OR, select previously entered journal for this author:</td>
							</tr>
							<tr>								
								<td>
									<input type="text" name="jtitle" id="jtitle" /><button type="button" class="btn btn-append" onclick="getSuggests($('#jtitle').val());">get journal titles</button>
								</td>
								<td>
									<select name="prev_issn" id="prev_jtitle">
										<option value="">Select a previously entered journal</option>
										<?php
											$query = "SELECT jtitle, issn FROM citations WHERE person_id = '$author_id'";
											$result = $selfarchive_dbconnect->query($query) or die($selfarchive_dbconnect->error.__LINE__);						
											if($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) { ?>
														 <option value="<?php echo $row['issn']; ?>">
															<?php echo $row['jtitle']; ?>
														</option>
											  		<?php }
												}
												else {
													echo 'No journals entered yet.';	
												}
									  		?> 		
									</select>
								</td>
							</tr>
							<tr> <!-- for keywords results -->								
								<td>
									<div id="journal_search">					
										<ul>search results may take a second depending on terms...</ul>
									</div>
								</td>
								<td></td> <!-- empty column -->
							</tr>
						</tbody>
					</table>												
				</li>
			
			<li>
				<label class="green"><b>Paste Citations here:</b></label>
					<!-- ckeditor textarea -->
					<textarea id="citation_text" name="citation_text" style="display:hidden;"></textarea>
					<script type="text/javascript">
						//instatiates editor
						CKEDITOR.replace( 'citation_text', {
							toolbar : [['Source','-','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Checkbox', 'Image', 'Styles','Format','Font','FontSize', 'TextColor','BGColor' ]]
						});
					</script>
			</li>
			<input type="hidden" name="author_id" value="<?php echo $author_id; ?>" />
			<input type="submit" value="check permissions" />
		</form>

	</div>
<?php } 

else { ?>
	<div id="page_content">
		<p>Not sure who we are working with, <a href='index.php'>return to author / project selection</a>.</p>
	</div>
<?php }

//footer
require_once('footer.php');
?>
