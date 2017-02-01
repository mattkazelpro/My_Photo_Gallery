<?php
require('../config.php');
include("../include/functions.php");

//mysqli_connect("$host", "$username", "$password")or die("cannot connect to the database."); 
//mysqli_select_db($conn, "$db_name")or die("cannot select the database.");

$result = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id = 1");
while($row = mysqli_fetch_array($result)) {
	$pagename = $row['pagename'];
	$template = $row['template'];
}



session_start();
if ($_SESSION['loggedIn'] != "true") {
	header("Location: ../login.php");
} else {
	$user_name = $_SESSION['username'];
	$user_level = $_SESSION['userlevel'];
	if ($user_level < 9) {
		header("Location: ../index.php");
	}
}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title><?php echo $pagename; ?> - Admin Panel</title>
<?php
echo "<link href='../template/$template' rel='stylesheet' type='text/css' />";
?>
</head>

<body>

<div align="center">
	<table border="0" width="1024" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" colspan="2" width="1024">
			<p align="center"><b><font size="6"><?php echo $pagename; ?></font></b><font size="5"><br>
			admin panel</font><br><br></td>
		</tr>
		<tr>
			<td valign="top" width="150">
			

				<table class="table" width="130">
					<tr class="table_header">
						<td class="table_header">Menu:</td>
					</tr>
					<tr>
						<td class="cell_content">
						<font size="2">
						<a href="index.php">Admin Home</a><br>
						<a href="../index.php">Main Website</a><br><br>
						<a href="not_active.php">Images not active</a><br>
						<a href="../upload.php">Upload Image</a><br><br>
						<a href="cat_management.php">Cat management</a><br><br>
						<a href="member_list.php">Members</a><br><br>
						<a href="settings_edit.php?settings=1">Edit Settings</a><br><br>
						<a href="logout.php">Logout</a></td>



						</font>
					</tr>
				</table>			
			
			
			
			</td>
			<td valign="top" width="850">