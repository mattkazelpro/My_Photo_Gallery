<?php
if(isset($_GET["login"])){
$loginfail = $_GET['login'];
}else{
?>
<div align="center">
<table class="table" width="160" class="table">
	<tr class="table_header">
		<td colspan="2">Login Failed</td>
	</tr>
	<tr class="row3">
		<td>You have failed to login.</td>
	</tr>
</table>
</div>
<br>
<?php 
} 
if (isset($user_name)) {
	include "include/panels/logged_in.php";
} else {
?>
<form name="form1" method="post" action="include/checklogin.php">
<div align="center">
<table class="table" width="160" class="table">
	<tr class="table_header">
		<td colspan="1">User Login</td>
	</tr>
	<tr class="row1">
		<td><center>Username:<br>
		<input name="username" size="15" type="text" id="username"></center></td>
	</tr>
	<tr class="row1">
		<td><center>Password:<br>
		<input name="password" size="15" type="password" id="password"></center></td>
	</tr>
	<tr class="row1">
		<td><br><center><input type="submit" name="Submit" value="Login"></center></td>
	</tr>
</table>
</div>
</form>
<?php 
}

?>