<?php
//==========================
//===Getting Info===========
//==========================
//Total Images
$total_images = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ".$prefix."images WHERE img_active=1"));

//Votes and average
$query1 = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id=1");
while ($row1 = mysqli_fetch_array($query1)) {
	$total_votes = $row1['total_votes'];
	$total_points = $row1['total_points'];
	if ($total_votes == 0) {
		$average = "n.a.";
	} else {
		$average = $total_points/$total_votes;
	}
	$total_img_views = $row1['total_img_views'];
}

//Total Members
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ".$prefix."users"));

//Newest Member
$query2 = mysqli_query($conn, "SELECT * FROM ".$prefix."users ORDER BY id DESC LIMIT 0 , 1");
while ($row2 = mysqli_fetch_array($query2)) {
	$newest_member = $row2['username'];
	$user_id = $row2['id'];
}

//==========================
//===Getting Info===========
//==========================
?>


<table class="table" width="160">
	<tr class="table_header">
		<td>Statics:</td>
	</tr>
	<tr class="row1">
		<td>
<?php
			echo "Total Images: $total_images\n<br>";
			echo "Total views: $total_img_views\n<br>";
			echo "Total Votes: $total_votes\n<br>";
			echo "Vote Average: $average\n<br>";
			echo "Total Members: $total_users\n<br>";
			echo "Last member: $newest_member\n<br>";
?>
		</td>
	</tr>
</table>