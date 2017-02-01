<?php
require('include/header.php');



if (isset($_POST['submit'])) {
?>
<table class="table" width="100%">
	<tr class="table_header">
		<th class="table_header" colspan="2">
		<p align="left">Add a category results</th>
	</tr>
	<tr>
		<td class="cell_content">
<?php


$sql="SELECT MAX(cat_order) AS cat_order FROM ".$prefix."categories";
$result=mysqli_query($conn, $sql);
while ($row=mysqli_fetch_array($result)) {
	$cat_order=$row["cat_order"]+1;
}

$sql="INSERT INTO ".$prefix."categories (cat_name)
 VALUES
 ('$_POST[category]')";
 
if (!mysqli_query($conn, $sql))
   {
   die('Error: ' . mysql_error());
   }
 echo "Your category is added succesfully to the database.";



?>
		</span></td>
	</tr>
	</table>
	<br>
<?php

}


?>
<form action="cat_management.php" method="post">
 <div align="center">
 <table class="table" width="100%">
	<tr class="table_header">
		<td class="table_header" colspan="3">Add a Category</td>
	</tr>
	<tr class="row1">
		<td width="150">Category Name:</td>
		<td width="250"> <br>
		<input type="text" name="category" size="25" /><br>
&nbsp;</td>
		<td> 
 <input type="submit" name="submit" value="Add Category" /></td>
	</tr>

	</table>
 </div>
 </form>
<?php


//==================================
//===edit delete cats===============
//==================================
?>
 <table class="table" width="35%">
	<tr class="table_header">
		<td class="table_header" colspan="3">Edit/Delete Category</td>
	</tr>

<?php
$row=1;
$query1 = mysqli_query($conn, "SELECT * FROM ".$prefix."categories ORDER BY cat_name");
while ($row1 = mysqli_fetch_array($query1)) {
	$catid = $row1['cat_id'];
	$catname = $row1['cat_name'];
?>

	<tr class="row<?php echo $row; ?>">
		<td width="20"><?php echo $catid; ?></td>
		<td width="150"><?php echo $catname; ?></td>
		<?php echo "<td width='40'>
			<a href='cat_edit.php?catid=$catid'><img border='0' width='16' src='images/edit_icon.png'></a>
			<a href='cat_delete.php?catid=$catid'><img border='0' width='16' src='images/delete_icon.png'></a>
		</td>
	</tr>";


$row=$row+1;
if ($row == 3) {
	$row=1;
}
}
?>

	</table>








<?php
require('include/footer.php');
?>