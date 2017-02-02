<?php
require('include/header.php');


$thumb_count = 0;
$colspan = $thumb_cells;
$start=0;
$limit=$thumb_rows*$thumb_cells;

if(isset($_GET['id'])) {
	$id=$_GET['id'];
	$start=($id-1)*$limit;
} else {
	$id = 1;
}


echo"
<table class='table' width='680'>
	<tr class='table_header'>
		<td>Images</td>
	<tr class='row1'>
		<td>z


		<table class='table1' width='680'>
			<tr class='row1'>";

if(isset($_GET['catid'])) {
	$cat_id=$_GET['catid'];
	$result = mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_active=1 AND img_cat=$cat_id ORDER BY img_id LIMIT $start, $limit");
	$rows=mysqli_num_rows($result);
} else {
	$result = mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_active=1 ORDER BY img_id LIMIT $start, $limit");
	$rows=mysqli_num_rows($result);
}
while($row = mysqli_fetch_array($result)) {
	$img_id = $row['img_id'];
	$img_name = $row['img_name'];
	$img_cat = $row['img_cat'];
	$img_desc = $row['img_desc'];
	$img_date = $row['img_date'];
	$img_uploader = $row['img_uploader'];
	$img_upl_ip = $row['img_upl_ip'];
	$img_filename = $row['img_filename'];
	$img_filesize = $row['img_filesize'];
	$img_filesize = formatBytes($img_filesize);
	$img_resolution = $row['img_resolution'];
	$img_views = $row['img_views'];
	$img_votes = $row['img_votes'];
	$img_points = $row['img_points'];
	if ($img_votes == 0) {
		$img_average = "n.a.";
	} else {
		$img_average = $img_points / $img_votes;
		$img_average = round($img_average, 2);
	}
	//$img_average = $img_points / $img_votes;
	//$img_average = round($img_average, 2);
	//if ($img_average == "") {$img_average = "n.a.";}
		if ($thumb_count == $thumb_cells) {
			echo "</tr>
			<tr class='row1'>";
			$thumb_count = 0;
			//$colspan = 3;
		}

			echo "<td valign='top'>";
				include "include/thumb_cell.php";
			echo "</td>";




$thumb_count=$thumb_count+1;

}
	echo "</tr>";


	if ($rows == 0) { echo "There are no images to show."; }


echo "</table>
		</td>
	</tr>";
echo "</table><br>";







//Pagination
echo "<table class='table' width='680'>
	<tr class='table_header'>
		<td colspan='2'>Pagination an Information</td>
	</tr>
	<tr class='row1'>
		<td align='left' STYLE='padding: 25px'>";

if(isset($_GET['catid'])) {
	$rows=mysqli_num_rows(mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_cat=$cat_id AND img_active=1"));
} else {
	$rows=mysqli_num_rows(mysqli_query($conn, "select * FROM ".$prefix."images WHERE img_active=1"));
}
$total=ceil($rows/$limit);

if($id>1) {
	if(isset($_GET['catid'])) {
		echo "<a href='?catid=".$cat_id."&id=".($id-1)."' class='button'>PREVIOUS</a> - ";
	} else {
		echo "<a href='?id=".($id-1)."' class='button'>PREVIOUS</a> - ";
	}
}

if ($rows > 0) {
	if($id!=$total) {
		if(isset($_GET['catid'])) {
			echo "<a href='?catid=".$cat_id."&id=".($id+1)."' class='button'>NEXT</a> - ";
		} else {
			echo "<a href='?id=".($id+1)."' class='button'>NEXT</a> - ";
		}
	}
}

for($i=1;$i<=$total;$i++) {
	if($i==$id) { echo $i." ";
} else {
	if(isset($_GET['catid'])) {
		echo "<a href='?catid=".$cat_id."&id=".$i."'>".$i."</a> ";
	} else {
		echo "<a href='?id=".$i."'>".$i."</a> ";
	}

}
}

$end=$start+$limit;
$start++;

		echo"</td>
		<td td align='right' style='padding-right:25px'>
			Found $rows images on $total pages.<br>Showing image $start to $end.</td>
	</tr>
</table>";
//End Pagination


require('include/footer.php');
?>