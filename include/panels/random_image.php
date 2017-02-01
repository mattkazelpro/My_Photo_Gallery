<table class="table" width="160">
	<tr class="table_header">
		<td>Random Image:</td>
	</tr>
	<tr class="row1">
		<td>
<?php
			$query2 = mysqli_query($conn, "SELECT * FROM ".$prefix."images ORDER BY RAND() LIMIT 1");
			while ($row = mysqli_fetch_array($query2)) {
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
				$img_views = $row['img_views'];
				include "include/thumb_cell.php";
			}
?>
		</td>
	</tr>
</table>