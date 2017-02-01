<?php
require('include/header.php');
?>

<?php
$loginfail = isset($_GET['login']);
if (!$loginfail) {
?>
<div align="center">
<table class="table" width="300" class="table">
	<tr class="table_header">
		<td colspan="2">Login Failed</td>
	</tr>
	<tr class="row3">
		<td>You have failed to login.</td>
	</tr>
</table>
</div>
<br><br>
<?php } ?>




<form name="form1" method="post" action="include/checklogin.php">
<div align="center">
<table class="table" width="680" class="table">
	<tr class="table_header">
		<td colspan="2"><?php echo $pagename; ?> - Login</td>
	</tr>
	<tr class="row1">
		<td>Username</td>
		<td><input name="username" type="text" id="username"></td>
	</tr>
	<tr class="row1">
		<td>Password</td>
		<td><input name="password" type="password" id="password"></td>
	</tr>
	<tr class="row1">
		<td>&nbsp;</td>
		<td><br><input type="submit" name="Submit" value="Login"></td>
	</tr>
</table>
</div>
</form>

<?php
require('include/footer.php');
?>