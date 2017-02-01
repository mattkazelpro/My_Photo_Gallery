<?php
require('include/header.php');
$catid = $_GET['catid'];
$result = mysqli_query($conn, "SELECT * FROM ".$prefix."categories WHERE cat_id = ".$catid." ORDER BY cat_id");

while($row = mysqli_fetch_array($result)) {
$catid = $row['cat_id'];
$catname = $row['cat_name'];
?>

<table class="table" width="100%">
	<tr class="table_header">
		<td>Delete a category</td>
	</tr>
	<tr class="row1">
		<td>
			<form action="cat_delete.php?catid=<?php echo $catid ?>" method="post">
				<p align="center">Are you sure you want to delete the category: <b><?php echo $catname; ?></b></p>
				<p align="center"><br><input type="submit" name="submit" value="Yes" />

					<script>
					function goBack()
					   {
					   window.history.back()
					   }
					</script>
				
				<input type="button" value="No" onclick="goBack()" />
 			</form>
		</td>
	</tr>
</table>

<?php
}


if (isset($_POST['submit'])) {
?>
<br><br><table class="table" width="100%">
	<tr class="table_header">
		<td>Delete a category results</td>
	</tr>
	<tr class="row1">
		<td>
			<?php
				$sql = "DELETE FROM ".$prefix."categories WHERE cat_id=".$catid;
				if (!mysqli_query($conn, $sql))
  				{
   					die('Error: ' . mysqli_error());
   				}
 				echo "Your category is deleted succesfully from the database.";
			?>
		</td>
	</tr>
</table>
<?php
}



require('include/footer.php');
?>