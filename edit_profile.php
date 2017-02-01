<?php
require('include/header.php');
//$usernameid = $_GET['username'];
//echo $user_name;
//echo $user_level;
//echo $user_id;

if (isset($_POST['submit'])) {
	$usernameid = $_GET['username'];
?>	
<table class="table" width="680" class="table">
	<tr class="table_header">
		<td>Edit profile</td>
	</tr>
	<tr class="row1">
		<td>
		<span class="genmed">
<?php
$password = md5($_POST[password]);
$sql = "UPDATE ".$prefix."users SET password='$password' WHERE id=".$usernameid; 
if (!mysqli_query($conn, $sql))
   {
   die('Error: ' . mysql_error());
   }
echo "Your password is edited succesfully.";



?>
		</span></td>
	</tr>
</table>
<br>
<?php
}




//$result = mysql_query("SELECT * FROM ".$prefix."users WHERE username = '".$user_name."' ORDER BY id");
//while($row = mysql_fetch_array($result)) {
//$username = $row['username'];
//$password = $row['password'];


?>
<form action="edit_profile.php?username=<?php echo $user_id; ?>" method="post">
<table class="table" width="680" class="table">
	<tr class="table_header">
		<td colspan="2">Edit Profile</td>
	</tr>
	<tr class="row1">
		<td width="120">Password: </td>
		<td><input type="password" name="password" size="20" value="" /></td>

	<tr class="row3">
		<td></td>
		<td><input type="submit" name="submit" value="Edit Profile" /></td>
	</tr>
	</table>
</form>
<?php
//}







require('include/footer.php');

?>