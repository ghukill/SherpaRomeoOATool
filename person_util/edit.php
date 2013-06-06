<? 
include('config.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Array` SET  `name` =  '{$_POST['name']}' ,  `status` =  '{$_POST['status']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Array` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<p><b>Name:</b><br /><input type='text' name='name' value='<?= stripslashes($row['name']) ?>' /> 
<p><b>Status:</b><br /><input type='text' name='status' value='<?= stripslashes($row['status']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
