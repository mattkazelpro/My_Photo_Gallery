<?php
require('include/header.php');
$imgid = $_GET['imgid'];
$result = mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_id = ".$imgid." ORDER BY img_id");

while($row = mysqli_fetch_array($result)) {
$imgid = $row['img_id'];
$imgname = $row['img_name'];
$imgfilename = $row['img_filename'];
?>

<table class="table" width="100%">
	<tr class="table_header">
		<td>Delete a link</td>
	</tr>
	<tr class="row1">
		<td>
			<form action="image_delete.php?imgid=<?php echo $imgid ?>" method="post">
				<p align="center">Are you sure you want to delete the image: <b><?php echo $imgname; ?></b><br>
				<img border='0' src='../uploads/thumbs/<?php echo $imgfilename; ?>'></p>
				<p align="center"><br>
				<input type="submit" name="submit" value="Yes" />

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
		<td>Delete a image results</td>
	</tr>
	<tr class="row1">
		<td>
			<?php
				$sql = "DELETE FROM ".$prefix."images WHERE img_id=".$imgid;
				if (!mysqli_query($conn, $sql))
  				{
   					die('Error: ' . mysql_error());
   				}
 				echo "Your image is deleted succesfully from the database.";
				unlink('../uploads/'.$imgfilename);
				unlink('../uploads/thumbs/'.$imgfilename);
				unlink('../uploads/orginal/'.$imgfilename);
			?>
		</td>
	</tr>
</table>
<?php
}



require('include/footer.php');
?>