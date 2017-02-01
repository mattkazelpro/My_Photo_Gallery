<?php
require('include/header.php');
$settingsid = $_GET['settings'];



if (isset($_POST['submit'])) {
?>	
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td>Change Settings</td>
	</tr>
	<tr class="row1">
		<td>
		<span class="genmed">
<?php
$sql = "UPDATE ".$prefix."settings SET pagename='$_POST[pagename]', slogan='$_POST[slogan]', email='$_POST[email]', template='$_POST[template]', hitcounter='$_POST[hitcounter]', hitcounterimg='$_POST[hitcounterimg]', max_filesize='$_POST[max_filesize]', max_width='$_POST[max_width]', max_height='$_POST[max_height]', thumb_size='$_POST[thumb_size]', normal_size='$_POST[normal_size]', thumb_cells='$_POST[thumb_cells]', thumb_rows='$_POST[thumb_rows]', search_suggestions='$_POST[search_suggestions]' WHERE id=".$settingsid; 
if (!mysqli_query($conn, $sql))
   {
   die('Error: ' . mysql_error());
   }
 echo "Your settings are edited succesfully in the database.";
?>
		</span></td>
	</tr>
</table><br><br>
<?php
}




$result = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id = ".$settingsid." ORDER BY id");
while($row = mysqli_fetch_array($result)) {
	$pagename = $row['pagename'];
	$slogan = $row['slogan'];
	$email = $row['email'];
	$template = $row['template'];
	$hitcounterimg = $row['hitcounterimg'];
	$hitcounter = $row['hitcounter'];
	$max_filesize = $row['max_filesize'];
	$max_width = $row['max_width'];
	$max_height = $row['max_height'];
	$thumb_size = $row['thumb_size'];
	$normal_size = $row['normal_size'];
	$thumb_cells = $row['thumb_cells'];
	$thumb_rows = $row['thumb_rows'];
	$search_suggestions = $row['search_suggestions'];
?>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>?settings=<?php echo $settingsid; ?>" method="post">
<table class="table" border="0" width="100%">
	<tr class="table_header">
		<td colspan="2">Edit settings</td>
	</tr>
	<tr class="row1">
		<td width="200">
		Header Name: </td>
		<td>
		<br>
		<input name="pagename" size="20" value="<?php echo $pagename; ?>" /><br>&nbsp;</td>
	</tr>
	<tr class="row2">
		<td width="200">
		Slogan: </td>
		<td>
		<br>
		<input name="slogan" size="40" value="<?php echo $slogan; ?>" /><br>&nbsp;</td>
	</tr>
	<tr class="row1">
		<td width="200">
		<br>
		Your E-Mail<br>
&nbsp;</td>
		<td>
		<input name="email" size="30" value="<?php echo $email; ?>" /></td>
	</tr>




	<tr class="row2">
		<td width="200">
		Template: </td>
		<td><br>
		<select size="5" name="template">
			<?php
				$directory = "../template/";
				$images = glob($directory . "*.css");
				foreach($images as $image)

				{
					$files = str_replace($directory, "", $image);
					echo "<option";

					if ($template == $files) 
						echo " selected";
					


					echo ">";
					echo $files;
					echo "</option>";
				}
			?>
		</select>
		<br><br></td>
	</tr>



	<tr class="row1">
		<td width="200">
		Hitcounter: </td>
		<td>
		<br>
		<input name="hitcounter" size="7" value="<?php echo $hitcounter; ?>" /> Pageloads<br>&nbsp;</td>
	</tr>



	<tr class="row2">
		<td width="200">
		Counter Image: </td>
		<td><br>
			<?php
				$directory1 = "../counterimages/";
				$images1 = glob($directory1 . "*.gif");
				foreach($images1 as $image1)
				{
					$files1 = str_replace($directory1, "", $image1);
					$dirname = substr($files1, 0, -4);  
					echo "<input type='radio' value='".$dirname."' name='hitcounterimg'";

					if ($hitcounterimg == $dirname) {
						echo " checked";
					}
							
					echo ">";
					echo "<img border='0' src='../counterimages/".$files1."'><br>";
				}
			?>
		<br></td>
	</tr>



	<tr class="row1">
		<td width="200">
		Maximal image filesize: </td>
		<td>
		<br>
		<input name="max_filesize" size="10" value="<?php echo $max_filesize; ?>" /> <?php echo formatBytes($max_filesize); ?><br>&nbsp;</td>
	</tr>



	<tr class="row2">
		<td width="200">
		Maximal image resolution: </td>
		<td>
		<br>
		<input name="max_width" size="5" value="<?php echo $max_width; ?>" /> x <input name="max_height" size="5" value="<?php echo $max_height; ?>" /> Pixels<br>&nbsp;</td>
	</tr>


	<tr class="row1">
		<td width="200">
		Thumbnail Size (Width): </td>
		<td>
		<br>
		<input name="thumb_size" size="5" value="<?php echo $thumb_size; ?>" /> Pixels<br>&nbsp;</td>
	</tr>


	<tr class="row2">
		<td width="200">
		Normal Size (Width): </td>
		<td>
		<br>
		<input name="normal_size" size="5" value="<?php echo $normal_size; ?>" /> Pixels<br>&nbsp;</td>
	</tr>



	<tr class="row1">
		<td width="200">
		Thumbnail Cells: </td>
		<td>
		<br>
		<input name="thumb_cells" size="3" value="<?php echo $thumb_cells; ?>" /><br>&nbsp;</td>
	</tr>


	<tr class="row2">
		<td width="200">
		Thumbnail Rows: </td>
		<td>
		<br>
		<input name="thumb_rows" size="5" value="<?php echo $thumb_rows; ?>" /><br>&nbsp;</td>
	</tr>

	<tr class="row2">
		<td width="200">
		Search suggestions: </td>
		<td>
		<br>
		<input name="search_suggestions" size="5" value="<?php echo $search_suggestions; ?>" /><br>&nbsp;</td>
	</tr>


	<tr class="row3">
		<td width="150">
		&nbsp;</td>
		<td>
 <br>
 <input type="submit" name="submit" value="Edit Settings" /><br>&nbsp;</td>
	</tr>
	</table>
</form>

<?php

}

require('include/footer.php');

?>