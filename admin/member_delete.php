<?php
require('include/header.php');
$member_id = $_GET['member_id'];
$result = mysqli_query($conn, "SELECT * FROM ".$prefix."users WHERE id = ".$member_id." ORDER BY id");

while($row = mysqli_fetch_array($result)) {
$member_id = $row['id'];
$username = $row['username'];
?>

<table class="table" width="100%">
	<tr class="table_header">
		<td>Delete a member</td>
	</tr>
	<tr class="row1">
		<td>
			<form action="member_delete.php?member_id=<?php echo $member_id ?>" method="post">
				<p align="center">Are you sure you want to delete this member: <b><?php echo $username; ?></b></p>
				<p align="center"><br><input type="submit" name="submit" value="Yes" />

					<script>
					function goBack()
					   {
					   window.history.back()
					   }
					</script>
				
				<input type="button" value="No" onclick="goBack()" />
 			</form>
		</td>
	</tr>
</table>

<?php
}


if (isset($_POST['submit'])) {
?>
<br><br><table class="table" width="100%">
	<tr class="table_header">
		<td>Delete a member results</td>
	</tr>
	<tr class="row1">
		<td>
			<?php
				$sql = "DELETE FROM ".$prefix."users WHERE id=".$member_id;
				if (!mysqli_query($conn, $sql))
  				{
   					die('Error: ' . mysqli_error());
   				}
 				echo "Your member is deleted succesfully.";
			?>
		</td>
	</tr>
</table>
<?php
}



require('include/footer.php');
?>