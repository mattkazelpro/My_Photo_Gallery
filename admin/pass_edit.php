<?php
require('include/header.php');
$usernameid = $_GET['username'];



if (isset($_POST['submit'])) {
?>	
<table class="table" width="500" class="table">
	<tr class="table_header">
		<td>Change the password</td>
	</tr>
	<tr class="row1">
		<td>
		<span class="genmed">
<?php
$sql = "UPDATE ".$prefix."users SET password='$_POST[password]' WHERE id=".$usernameid; 
if (!mysqli_query($conn, $sql))
   {
   die('Error: ' . mysqli_error());
   }
echo "Your password is edited succesfully.";



?>
		</span></td>
	</tr>
</table>
<?php
}




$result = mysqli_query($conn, "SELECT * FROM ".$prefix."users WHERE username = 'admin' ORDER BY id");
while($row = mysqli_fetch_array($result)) {
$username = $row['username'];
$password = $row['password'];


?>
<form action="pass_edit.php?username=<?php echo $usernameid; ?>" method="post">
<table class="table" width="500" class="table">
	<tr class="table_header">
		<td colspan="3">Edit the password</td>
	</tr>
	<tr class="row1">
		<td width="120">
		Password: </td>
		<td>
		<br>
		<input type="password" name="password" size="20" value="<?php echo $password; ?>" /><br>
&nbsp;</td>
		<td width="75%">
 <input type="submit" name="submit" value="Edit Password" /></td>
	</tr>
	</table>
</form>
<?php
}







require('include/footer.php');

?>