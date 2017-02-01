<?php
require('include/header.php');



if (isset($_POST['submit'])) {
?>
<table class="table" width="100%">
	<tr class="table_header">
		<th class="table_header" colspan="2">
		<p align="left">Add a category</th>
	</tr>
	<tr>
		<td class="cell_content">
<?php
//read out the faqs


$sql="SELECT MAX(cat_order) AS cat_order FROM ".$prefix."categories";
$result=mysqli_query($conn, $sql);
while ($row=mysql_fetch_array($result)) {
	$cat_order=$row["cat_order"]+1;
}

$sql="INSERT INTO ".$prefix."categories (cat_name)
 VALUES
 ('$_POST[category]')";
 
if (!mysqli_query($sql))
   {
   die('Error: ' . mysql_error());
   }
 echo "Your category is added succesfully to the database.";



?>
		</span></td>
	</tr>
	</table>
<?php

}




?>
<form action="cat_add.php" method="post">
 <div align="center">
 <table class="table" width="100%">
	<tr class="table_header">
		<td class="table_header" colspan="2">Add a Category</td>
	</tr>
	<tr class="row1">
		<td width="150">Category Name:</td>
		<td> <br>
		<input type="text" name="category" size="15" /><br>
&nbsp;</td>
	</tr>

	<tr class="row3">
		<td>
 &nbsp;</td>
		<td>
 <p align="left"><br>
 <input type="submit" name="submit" value="Add Category" /><br>
&nbsp;</td>
	</tr>
	</table>
 </div>
 </form>
<?php
require('include/footer.php');
?>