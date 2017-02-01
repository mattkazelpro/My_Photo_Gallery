<?php
require('include/header.php');
$rowcount = 1;
$start=0;
$limit=10;
$id=1;

if(isset($_GET['id'])) {
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

//echo "test";
//echo $user_name;
//echo $user_level;

//=============================
//===Actions===================
//=============================
if (isset($_GET['action'])) {

	echo"<table class='table' width='100%'>
		<tr class='table_header'>
			<td>Action</td>
		</tr>
		<tr class='row1'>
			<td>Your Image is: ".$_GET['action']."</td>
		</tr>
	</table>
	<br>";

	if ($_GET['action']="deactivate") {
 		mysqli_query($conn, "UPDATE ".$prefix."images SET img_active=0 WHERE img_id=".$_GET['imgid']);
	}

	if ($_GET['action']="activate") {
 		mysqli_query($conn, "UPDATE ".$prefix."images SET img_active=1 WHERE img_id=".$_GET['imgid']);
	}
}
//=============================
//===End Actions===============
//=============================



	echo "<table class='table' width='100%' class='table'>
		<tr class='table_header'>
			<td colspan='7'>
				Images
			</td>
		</tr>
		<tr class='row3'>
			<td>Thumbnail</td>
			<td>Imagename</td>
			<td>Category name</td>
			<td>Date uploaded</td>
			<td>uploader and IP</td>
			<td>Average</td>
			<td>options</td>
		</tr>";



  $query1 = mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_active=0 ORDER BY img_id LIMIT $start, $limit");
  while ($row1 = mysqli_fetch_array($query1)) {
	$imgid = $row1['img_id'];
	$imgname = $row1['img_name'];
	$imgcategory = $row1['img_cat'];
		$query2 = mysqli_query($conn, "SELECT * FROM ".$prefix."categories WHERE cat_id = ".$imgcategory);
		while ($row2 = mysqli_fetch_array($query2)) {
			$catname = $row2['cat_name'];
		}
	$imgfilename = $row1['img_filename'];
	$imgdate = $row1['img_date'];
	$imguploader = $row1['img_uploader'];
	$imguploaderip = $row1['img_upl_ip'];
	$img_votes = $row1['img_votes'];
	$img_points = $row1['img_points'];
	if ($img_votes == 0) {
		$img_average = "n.a.";
	} else {
		$img_average = $img_points / $img_votes;
		$img_average = round($img_average, 2);
	}

		echo "<tr class='row$rowcount'>
			<td><a target='_blank' href='../image.php?imgid=$imgid'><img border='0' src='../uploads/thumbs/$imgfilename'></td>
			<td>$imgname</td>
			<td>$catname</td>
			<td>$imgdate</td>
			<td>
				<a target='_blank' href='../useruploads.php?username=$imguploader'>$imguploader</a><br>
				<a target='_blank' href='http://whois.domaintools.com/$imguploaderip'>$imguploaderip</a>
			</td>
			<td>$img_points / $img_votes = $img_average
			</td>
			<td width='40'>
				<a href='image_edit.php?imgid=$imgid'><img width ='16' border='0' title='Edit Image' src='images/edit_icon.png'></a>
				<a href='image_delete.php?imgid=$imgid'><img width ='16' border='0' title='Delete Image' src='images/delete_icon.png'></a>
				<a href='not_active.php?imgid=$imgid&action=activate'><img width ='16' border='0' title='Activate Image' src='images/activate_icon.png'></a>
			</td>
		</tr>";

		$rowcount = $rowcount + 2;
		if ($rowcount == 5) {
			$rowcount = 1;
		}

}


//Pagination
echo "<tr class='row$rowcount'><td colspan='7'>";
$rows=mysqli_num_rows(mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_active=0"));
$total=ceil($rows/$limit);

if($id>1) {
	echo "<a href='?id=".($id-1)."' class='button'>PREVIOUS</a> - ";
}
if($id!=$total) {
	echo "<a href='?id=".($id+1)."' class='button'>NEXT</a> - ";
}


for($i=1;$i<=$total;$i++) {
	if($i==$id) {
		 echo $i." ";
	} else {
		echo "<a href='?id=".$i."'>".$i."</a> ";
	}
}
echo "</td></tr>";
//End Pagination




	echo "</table><br>";






//echo "</table>";



require('include/footer.php');
?>