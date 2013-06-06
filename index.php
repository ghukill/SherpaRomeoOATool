<?php
require_once('db.php');
require_once('header.php');
?>

<!-- remove current author status from header -->
<script type="text/javascript">
	$('#nav').remove();
</script>

<div id="page_content">
	<p>To begin, select an Author / Project below.</p>	
	<form id="author_select" class="forms" name="author_select" action="citations.php" method="GET">
		<select name="author_id" id="author_id">
			<?php
				$stmt = $selfarchive_dbconnect->prepare("SELECT id, name FROM person");
				$stmt->execute(); 
				$stmt->bind_result($author_id, $author_name);
				while ( $row = $stmt->fetch() ) { ?>
					<option value="<?php echo $author_id; ?>">
						<?php echo $author_name; ?>
					</option>
		  		<?php } 
	  		?> 		
		</select>
		<input type="submit" class="btn btn-small" value="Begin" />
	</form>
	</br>
	</br>

	<p>Or, <a href="author_create.php">create a new Author / Project</a></p>	
</div>

<?php
require_once('footer.php');
?>