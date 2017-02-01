<table class="table" width="160">
	<tr class="table_header">
		<td>Logged in: <?php echo $user_name; ?></td>
	</tr>
	<tr class="row1">
		<td>
			<a href="edit_profile.php">Edit Profile</a><br>
			<a href="upload.php">Upload Image</a><br>
			<a href="logout.php">Log Out</a><br>

			<?php if ($user_level == 9) {
				echo "<br>";
				echo "<a href='admin/index.php'>Admin Panel</a><br>";
			} ?>
		</td>
	</tr>
</table>