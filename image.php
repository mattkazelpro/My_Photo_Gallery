<?php
require('include/header.php');
$imgid = $_GET["imgid"];


//====================================
//====Begin Send message==============
//====================================
if (isset($_POST['send_message'])) {
	echo "<table class='table' width='680'>
		<tr class='table_header'>
			<td>Message results</td>
		</tr>
		<tr class='row1'>
			<td>";
				session_start();
				if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{
					if (empty($_POST[name])) {
				 	  echo "ERROR: You have to fill in a name.";
					} elseif (empty($_POST[message])) {
				 	  echo "ERROR: You have to fill in a message.";
					} else {
						$now = date('Y-m-d h:i:s');
						$sql="INSERT INTO ".$prefix."comment (com_img_id, com_poster_name, com_message, com_poster_ip) VALUES ('$imgid', '$_POST[name]', '$_POST[message]', '$userip')";
						if (!mysqli_query($conn, $sql)) {
							die('Error: ' . mysqli_error());
						} else {
							echo "Thank you for your message.";
						}
					}


				} else {  
					echo "Oops, Wrong Captcha code.<br>Please try again.";
				}
			echo "</td>
		</tr>
	</table><br>";
}
//====================================
//====END Send message================
//====================================


//====================================
//====is voted========================
//====================================
if (isset($_POST['vote'])) {
	if ($_POST['vote'] > 0) {

		$sql = "UPDATE ".$prefix."images SET img_votes=img_votes+1 WHERE img_id=".$_POST[imgid];
			if (!mysqli_query($conn, $sql)) {
				die('Error: ' . mysqli_error());
			}
		$sql = "UPDATE ".$prefix."images SET img_points=img_points+".$_POST[vote]." WHERE img_id=".$_POST[imgid];
			if (!mysqli_query($conn, $sql)) {
				die('Error: ' . mysqli_error());
			}

		$sql = "UPDATE ".$prefix."settings SET total_votes=total_votes+1 WHERE id=1";
			if (!mysqli_query($conn, $sql)) {
				die('Error: ' . mysqli_error());
			}

		$sql = "UPDATE ".$prefix."settings SET total_points=total_points+".$_POST[vote]." WHERE id=1";
			if (!mysqli_query($conn, $sql)) {
				die('Error: ' . mysqli_error());
			}


		//begin votes
		$now = date('Y-m-d');
		$userip = $_SERVER['REMOTE_ADDR'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="INSERT INTO ".$prefix."votes (vote_ip, vote_date, vote_image_id, vote_points) VALUES ('$ip', '$now', '$_POST[imgid]', '$_POST[vote]')";
		if (!mysqli_query($conn, $sql)) {
			die('Error: ' . mysqli_error());
		}
	}
}
//====================================
//====END is voted====================
//====================================


//====================================
//====Begin read image to vote========
//====================================
if (isset($imgid)) {
	$result = mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_id=".$imgid);
}
while ($row = mysqli_fetch_array($result)) {
	$img_id = $row['img_id'];
	$img_name = $row['img_name'];
	$img_filename = $row['img_filename'];
	$img_cat = $row['img_cat'];
	$img_date = $row['img_date'];
	$img_uploader = $row['img_uploader'];
	$img_votes = $row['img_votes'];
	$img_points = $row['img_points'];
	if ($img_votes == 0) {
		$img_average = "n.a.";
	} else {
		$img_average = $img_points / $img_votes;
		$img_average = round($img_average, 2);
	}
	$img_desc = htmlentities($row['img_desc']);
	$img_desc = str_replace("\n", "<br>", $img_desc);
	$img_upl_ip = $row['img_upl_ip'];
	$img_filesize = $row['img_filesize'];
	$img_filesize = formatBytes($img_filesize);
	$img_resolution = $row['img_resolution'];
	$img_views = $row['img_views'];
}
?>
<div align="center">
	<table class="table" width="680">
	<tr class="table_header">
		<td width="600">Image: <?php echo $img_name; ?></td>
		<td><?php if ($user_level > 7) {?>
			<a href='admin/image_edit.php?imgid=<?php echo $img_id;?>'><img width ='16' border='0' src='admin/images/edit_icon.png'></a>
			<a href='admin/image_delete.php?imgid=<?php echo $img_id;?>'><img width ='16' border='0' src='admin/images/delete_icon.png'></a>
			<?php } ?>
		</td>
	</tr>
	<tr class="row1">
		<td colspan="2">
			<?php echo "<img border='0' src='uploads/".$img_filename."' width='678' alt='".$img_name."'>"; ?>
		</td>
	</tr>

<?php
//begin voting
	$result = mysqli_query($conn, "SELECT * FROM ".$prefix."votes WHERE vote_ip='".$userip."' AND vote_image_id=".$imgid);
	$num_rows1 = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result)) {
		$votepoints = $row['vote_points'];
	}
	if ($num_rows1 > 0) {
		echo "<tr class='row1'>
			<td colspan='2'>";
				echo "<center>You gave this image <b>".$votepoints."</b> points.<br>";
				//newimage();
			echo "</td>
		</tr>";
	} else {
	?>





	<tr class="row1">
		<td colspan="2">
			<form action='image.php?imgid=<?php echo $imgid; ?>' method='post'>
				<input type="hidden" name="imgid" value="<?php echo $imgid; ?>">
				<div align="center">
				<table border="0" width="420" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" width="42">1</td>
						<td align="center" width="42">2</td>
						<td align="center" width="42">3</td>
						<td align="center" width="42">4</td>
						<td align="center" width="42">5</td>
						<td align="center" width="42">6</td>
						<td align="center" width="42">7</td>
						<td align="center" width="42">8</td>
						<td align="center" width="42">9</td>
						<td align="center" width="42">10</td>
					</tr>
					<tr>
						<td align="center" width="42">
						<input type="radio" value="1" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="2" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="3" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="4" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="5" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="6" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="7" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="8" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="9" name="vote"></td>
						<td align="center" width="42">
						<input type="radio" value="10" name="vote"></td>
					</tr>
					<tr>
						<td>Break</td>
						<td colspan="8">
						<p align="center"><br>
						<input type="submit" value="Vote" name="voting"></td>
						<td>
						<p align="right">Make</td>
					</tr>
				</table>
				</div>
			</form>
		</td>
	</tr>

	<?php 
	} 
// end voting
?>


</table>



<?php


//====================================
//====Begin Image Information=========
//====================================
echo "<br><table class='table' width='680'>
	<tr class='table_header'>
		<td colspan='2'>Image Information</td>
	</tr>
	<tr class='row1'>
		<td width='50%'>
			Image Name: $img_name<br>
			<a target='_blank' href='uploads/orginal/$img_filename'>Download the orginal file</a><br>";

				$query3 = mysqli_query($conn, "SELECT * FROM ".$prefix."categories WHERE cat_id=".$img_cat);
				while ($row3 = mysqli_fetch_array($query3)) {
					$cat_id = $row3['cat_id'];
					$cat_name = $row3['cat_name'];
				}
			echo "Category: <a href='index.php?catid=$cat_id'>".$cat_name."</a><br>
			Views: ".$img_views."<br>
		</td>


		<td width='50%'>
			Date Added: $img_date<br>
			Name Uploader: <a href='useruploads.php?username=$img_uploader'>$img_uploader</a><br>
			Image vote results: $img_points / $img_votes = <b>$img_average</b>
		</td>
	</tr>
</table><br>";
//====================================
//====End Image Information===========
//====================================


//====================================
//====Begin Image Description=========
//====================================



if (strlen($img_desc) > 0) {
?>
				<table class="table" width="680">
					<tr class="table_header">
						<td>Image Description</td>
					</tr>
					<tr class="row1">
						<td>
							<?php echo $img_desc; ?>
						</td>
					</tr>
				</table><br>
<?php
}


//====================================
//====End Image Description===========
//====================================


//====================================
//====Begin Direct Links==============
//====================================

?>
<table class="table" width="680">
	<tr class="table_header">
		<td colspan="2">Image Codes</td>
	</tr>
	<tr class="row1">
		<td>
			BB-Code:<br>
			<input type="text" onFocus="this.select()" name="T1" size="70" value="[URL=<?php echo $script_url; ?>image.php?img_id=<?php echo $img_id; ?>][IMG]<?php echo $script_url; ?>uploads/thumbs/<?php echo $img_filename; ?>[/IMG][/URL]"><br><br>
			HTML Code:<br>
			<input type="text" onFocus="this.select()" name="T1" size="70" value="&lt;a href=&quot;<?php echo $script_url; ?>image.php?img_id=<?php echo $img_id; ?>&quot;&gt;&lt;img border=&quot;0&quot; src=&quot;<?php echo $script_url; ?>uploads/thumbs/<?php echo $img_filename; ?>&quot;&gt;&lt;/a&gt;">



		</td>
		<td>
			Preview:<br>
			<a href="<?php echo $script_url; ?>index.php?img_id=<?php echo $img_id; ?>"><img border="0" src="<?php echo $script_url; ?>uploads/thumbs/<?php echo $img_filename; ?>"></a>
		</td>
	</tr>
</table><br>
<?php


//====================================
//====End Direct Links================
//====================================

//====================================
//====Begin Show comments=============
//====================================
$row = 0;
echo "<table class='table' width='680'>
	<tr class='table_header'>
		<td>Image Comments</td>
	</tr>";



$query3 = mysqli_query($conn, "SELECT * FROM ".$prefix."comment WHERE com_img_id=".$imgid);
$num_rows2 = mysqli_num_rows($query3);
if ($num_rows2 == 0) {
		echo "<tr class='row1'>
			<td>There are no comments for this image.</b></td>
		</tr>";
} else {

	while ($row3 = mysqli_fetch_array($query3)) {
		$row = $row+1;
		$comid = $row3['com_id'];
		$comimgid = $row3['com_img_id'];
		$compostername = $row3['com_poster_name'];
		$comdate = $row3['com_date'];

		$commessage = htmlentities($row3['com_message']);
		$commessage = str_replace("\n", "<br>", $commessage);



			echo "<tr class='row3'>
				<td>This message is posted by: <b>$compostername</b> on <b>$comdate</b></td>
			</tr>
			<tr class='row$row'>
				<td>
					$commessage<hr>
				</td>
			</tr>";
		if ($row == 2) { $row = 0; }

	}
}
	echo "</table><br>";


//====================================
//====END Show comments==============
//====================================

//====================================
//====Begin Add comment===============
//====================================
echo "
	<form method='post' action='image.php?imgid=$imgid'>
		<table class='table' width='680'>
			<tr class='table_header'>
				<td colspan='3'>Add a comment</td>
			</tr>

			<tr class='row1'>
				<td width='150'><br>
					Your Name:<br>
				</td>
				<td colspan='2'>
					<input type='text' name='name' size='25' />
				</td>
			</tr>

			<tr class='row2'>
				<td valign='top'><br>
					Message:
				</td>
				<td colspan='2'><br>
					<textarea rows='11' name='message' cols='60'></textarea><br>
				</td>
			</tr>

			<tr class='row1'>
				<td><br>
					Captcha Code:<br>
				</td>
				<td width='98'>
					<input class='input' type='text' name='norobot' size='8' />
				</td>
				<td width='438'>
					<br>
					<img src='include/captcha.php' /><br><br>
				</td>
			</tr>

			<tr class='row3'>
				<td>&nbsp;</td>
				<td colspan='2'><br>
					<input type='submit' name='send_message' value='Send Message' /><br>
				</td>
			</tr>
		</table>
	</form>
<br>";


//====================================
//====End Add comment=================
//====================================


//====================================
//====Update Statics==================
//====================================

$sql = "UPDATE ".$prefix."settings SET total_img_views=total_img_views+1 WHERE id=1";
	if (!mysqli_query($conn, $sql)) {
		die('Error: ' . mysql_error());
	}

$sql = "UPDATE ".$prefix."images SET img_views=img_views+1 WHERE img_id=".$imgid;
	if (!mysqli_query($conn, $sql)) {
		die('Error: ' . mysql_error());
	}

//====================================
//====END Update Statics==============
//====================================


require('include/footer.php');
?>