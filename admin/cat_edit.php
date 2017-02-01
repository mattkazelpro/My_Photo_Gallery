<?php
require('include/header.php');
$catid = $_GET['catid'];



if (isset($_POST['submit'])) {
?>
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td>Edit a category Results</td>
	</tr>
	<tr class="row1">
		<td>
<?php
//read out the faqs
$sql = "UPDATE ".$prefix."categories SET cat_name='$_POST[name]' WHERE cat_id=".$catid; 
if (!mysqli_query($conn, $sql)) {
	   die('Error: ' . mysqli_error());
}
echo "Your category is edited succesfully in the database.";



?>
		</td>
	</tr>
</table>
<br>
<?php
}


?>
<form action="cat_edit.php?catid=<?php echo $catid; ?>" method="post">
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td colspan="3">Edit a category</td>
	</tr>

	<tr class="row1">
		<td>
<?php
$result = mysqli_query($conn, "SELECT * FROM ".$prefix."categories WHERE cat_id = ".$catid." ORDER BY cat_id") or die("A MySQL error has occurred.<br />Your Query: " . $your_query . "<br /> Error: (" . mysqli_errno() . ") " . mysql_error());
while($row = mysqli_fetch_array($result)) {
$catname = $row['cat_name'];


?>
		</td>
	</tr>

	<tr class="row1">
		<td width="150">Category Name:</td>
		<td width="250"><br>
		<input type="text" name="name" size="25" value="<?php echo $catname; ?>" /><br>
&nbsp;</td>
		<td>
		<input type="submit" name="submit" value="Edit Category" /></td>
	</tr>
	</table>
</form>




<?php

}

require('include/footer.php');

 ?>