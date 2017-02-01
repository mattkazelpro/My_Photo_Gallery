<?php
require('include/header.php');
$imgid = $_GET['imgid'];



if (isset($_POST['submit'])) {
	//$totalpoints = $_POST[total_points];
	//$totalvotes = $_POST[total_votes];


?>
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td>Edit a Image Results</td>
	</tr>
	<tr class="row1">
		<td>
<?php
//read out the faqs
$sql = "UPDATE ".$prefix."images SET img_cat='$_POST[category]', img_name='$_POST[name]', img_uploader='$_POST[uploader]', img_votes='$_POST[total_votes]', img_points='$_POST[total_points]', img_desc='$_POST[description]', img_active='$_POST[img_active]' WHERE img_id=".$imgid; 
if (!mysqli_query($conn, $sql)) {
	   die('Error: ' . mysqli_error());
}
echo "Your image is edited succesfully in the database.";



?>
		</td>
	</tr>
</table>
<br>
<?php
}


?>
<form action="image_edit.php?imgid=<?php echo $imgid; ?>" method="post">
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td colspan="2">Edit a image</td>
	</tr>

	<tr class="row1">
		<td>
<?php
$result3 = mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_id = ".$imgid." ORDER BY img_id");
while($row3 = mysqli_fetch_array($result3)) {
	$imgid = $row3['img_id'];
	$imgname = $row3['img_name'];
	$imgdate = $row3['img_date'];
	$imguploader = $row3['img_uploader'];
	$imgtotalvotes = $row3['img_votes'];
	$imgtotalpoints = $row3['img_points'];
	$imgdescription = $row3['img_desc'];
	$img_active = $row3['img_active'];


//read out the faqs
?>
		</td>
	</tr>

	<tr class="row1">
		<td width="150">Category:</td>
		<td><br>
		
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_id='".$imgid."' LIMIT 1");
    $result = mysqli_fetch_array($sql);
    $imgcategory = $result['img_cat'];
//echo $linkcategory;
    $query = mysqli_query($conn, "SELECT * FROM ".$prefix."categories");
    ?>
    <select name='category'>
    <?php
    while ($accessrow = mysqli_fetch_array($query)) {
    ?>
    <option value="<?php echo $accessrow['cat_id']; ?>" <?php if ($imgcategory == $accessrow['cat_id']) { echo 'selected'; } ?> ><?php echo $accessrow['cat_name']; ?></option><br><br>
    <?php } ?>
		
&nbsp;</select><br>
&nbsp;</td>
	</tr>
	<tr class="row2">
		<td>Image Name:</td>
		<td><br>
		<input type="text" name="name" size="30" value="<?php echo $imgname; ?>" /><br>
&nbsp;</td>
	</tr>
	<tr class="row1">
		<td>Name Uploader:</td>
		<td><br>
		<input type="text" name="uploader" size="30" value="<?php echo $imguploader; ?>" /><br>
&nbsp;</td>
	</tr>
	<tr class="row2">
		<td>Total Votes:</td>
		<td><br>
		<input type="text" name="total_votes" size="6" value="<?php echo $imgtotalvotes; ?>" /><br>
&nbsp;</td>
	</tr>
	<tr class="row1">
		<td>Total Points:</td>
		<td><br>
		<input type="text" name="total_points" size="10" value="<?php echo $imgtotalpoints; ?>" /><br>
&nbsp;</td>
	</tr>

	<tr class="row2">
		<td>Image Description:</td>
		<td><br>
		<textarea rows="7" name="description" cols="40"><?php echo $imgdescription; ?></textarea><br>
&nbsp;</td>
	</tr>



	<tr class="row1">
		<td>Image Status: </td>
		<td><br>
			<?php
					echo "<input type='radio' value='1' name='img_active'";
					if ($img_active == 1) {
						echo " checked";
					}
					echo "> Active";
					echo "<br>";
					echo "<input type='radio' value='0' name='img_active'";
					if ($img_active == 0) {
						echo " checked";
					}
					echo "> Deactive";
			?>
		<br><br></td>
	</tr>




	<tr class="row3">
		<td>&nbsp;</td>
		<td><br>
		<input type="submit" name="submit" value="Edit Image" /><br>
&nbsp;</td>
	</tr>
</table>
</form>




<?php

}

require('include/footer.php');

 ?>