<?php
require('include/header.php');
$member_id = $_GET['member_id'];



if (isset($_POST['submit'])) {
?>
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td>Member edit</td>
	</tr>
	<tr class="row1">
		<td>
<?php
//read out the faqs
$sql = "UPDATE ".$prefix."users SET username='$_POST[username]', email='$_POST[email]', user_level='$_POST[user_level]' WHERE id=".$member_id; 
if (!mysqli_query($conn, $sql)) {
	   die('Error: ' . mysqli_error());
}
echo "The member is edited succesfully.";


?>
		</td>
	</tr>
</table>
<br>
<?php
}


?>
<form action="member_edit.php?member_id=<?php echo $member_id; ?>" method="post">
<table class="table" width="100%" class="table">
	<tr class="table_header">
		<td colspan="2">Edit a member</td>
	</tr>

	<tr class="row1">
		<td>
<?php
$result = mysqli_query($conn, "SELECT * FROM ".$prefix."users WHERE id = ".$member_id." ORDER BY id") or die("A MySQL error has occurred.<br />Your Query: " . $your_query . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
while($row = mysqli_fetch_array($result)) {
$member_id = $row['id'];
$username = $row['username'];
$password = $row['password'];
$email = $row['email'];
$user_level = $row['user_level'];

//read out the faqs
?>
		</td>
	</tr>


	<tr class="row1">
		<td>Username:</td>
		<td><br>
		<input type="text" name="username" size="30" value="<?php echo $username; ?>" /><br>
&nbsp;</td>
	</tr>

	<tr class="row2">
		<td>E-Mail:</td>
		<td><br>
		<input type="text" name="email" size="30" value="<?php echo $email; ?>" /><br>
&nbsp;</td>
	</tr>


	<tr class="row1">
		<td>Member Level: </td>
		<td><br>
			<?php
					echo "<input type='radio' value='1' name='user_level'";
					if ($user_level == "1") {
						echo " checked";
					}
					echo "> Member";
					echo "<br>";
					echo "<input type='radio' value='9' name='user_level'";
					if ($user_level == "9") {
						echo " checked";
					}
					echo "> Admin";
			?>
		<br><br></td>
	</tr>




	<tr class="row3">
		<td>&nbsp;</td>
		<td><br>
		<input type="submit" name="submit" value="Edit Member" /><br>
&nbsp;</td>
	</tr>
</table>
</form>




<?php

}

require('include/footer.php');

 ?>