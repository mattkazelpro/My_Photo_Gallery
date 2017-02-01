<?php
require('../config.php');
mysql_connect("$host", "$username", "$password")or die("cannot connect to the database."); 
mysql_select_db("$db_name")or die("cannot select the database.");

$result = mysql_query("SELECT * FROM ".$prefix."settings WHERE id = 1");
while($row = mysql_fetch_array($result)) {
	$pagename = $row['pagename'];
	$template = $row['template'];
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title><?php echo $pagename; ?> - Admin Login</title>
<link href="../template/basic.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
$loginfail = $_GET['login'];
if ($loginfail == "fail") {
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
<table class="table" width="300" class="table">
	<tr class="table_header">
		<td colspan="2"><?php echo $pagename; ?> - Admin Login</td>
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
		<td><br><input type="submit" name="Submit" value="Admin Login"></td>
	</tr>
</table>
</div>
</form>

<p align="center"><br>Powered by <a href="http://software.friendsinwar.com" class="copyright">My Photo Gallery</a> © 2017 Friends in War Software</p>

</body>

</html>