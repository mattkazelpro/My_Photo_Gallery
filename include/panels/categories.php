<table class="table" width="160">
	<tr class="table_header">
		<td>Categories:</td>
	</tr>
	<tr class="row1">
		<td>
<?php
			echo "<a href='index.php'>All Categories</a><br>";
			$query1 = mysqli_query($conn, "SELECT * FROM ".$prefix."categories ORDER BY cat_name");
			while ($row1 = mysqli_fetch_array($query1)) {
				$catid = $row1['cat_id'];
				$catname = $row1['cat_name'];
				echo "<a href='index.php?catid=$catid'>$catname</a><br>";
			}
?>
		</td>
	</tr>
</table>