<?php
require('include/header.php');

$thumb_count = 0;
$colspan = $thumb_cells;

?>



<table class="table" width="680">
	<tr class="table_header">
		<td>Search</td>
	</tr>
	<tr class="row1">
		<td>


<?php
$val='';
if(isset($_POST['submit'])) {
	if(!empty($_POST['name'])) {
		$val=$_POST['name'];
	} else {
		$val='';
	}
}
?>
<br><center>
<form method="post" action="search.php">
	Search: <input type="text" class="search" name="name" id="name" autocomplete="off" value="<?php echo $val;?>">
	<input type="submit" name="submit" id="submit" value="Search">
	<div id="display"></div>
</form><center>




		<table class='table1' width='680'>
			<tr class='row1'>

<?php
if(isset($_POST['submit'])) {
	if(!empty($_POST['name'])) {
		$name=$_POST['name'];
		$query3=mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_name LIKE '%$name%' OR img_desc LIKE '%$name%' AND img_active=1");
		while($search=mysqli_fetch_array($query3)) {
			$img_id = $search['img_id'];
			$img_name = $search['img_name'];
			$img_cat = $search['img_cat'];
			$img_desc = $search['img_desc'];
			$img_date = $search['img_date'];
			$img_uploader = $search['img_uploader'];
			$img_upl_ip = $search['img_upl_ip'];
			$img_filename = $search['img_filename'];
			$img_filesize = $search['img_filesize'];
			$img_resolution = $search['img_resolution'];
			$img_views = $search['img_views'];
			$img_votes = $search['img_votes'];
			$img_points = $search['img_points'];
			if ($img_votes == 0) {
				$img_average = "n.a.";
			} else {
				$img_average = $img_points / $img_votes;
				$img_average = round($img_average, 2);
			}
			//$average = $img_points / $img_votes;
			//$average = round($average, 2);
			//if ($average == "") {
			//	$average = 0;
			//}

		if ($thumb_count == $thumb_cells) {
			echo "</tr>
			<tr class='row1'>";
			$thumb_count = 0;
		}

			echo "<td valign='top'>";
				include "include/thumb_cell.php";
			echo "</td>";
			$thumb_count=$thumb_count+1;

		}
	} else {
		echo "No Results";
	}
}
?>



</tr></table>



		</td>
	</tr>
</table>

<?php
require('include/footer.php');
?>