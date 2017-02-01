<?php
require('config.php');
include("include/functions.php");
$userip=$_SERVER['REMOTE_ADDR'];
$user_level = 0;
session_start();

$result = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id = 1");
while($row = mysqli_fetch_array($result)) {
	$pagename = $row['pagename'];
	$slogan = $row['slogan'];
	$template = $row['template'];
	$hitcounter = $row['hitcounter'];
	$hitcounterimg = $row['hitcounterimg'];
	$installed = $row['installed'];
	$script_url = $row['script_url'];
	$max_filesize = $row['max_filesize'];
	$max_width = $row['max_width'];
	$max_height = $row['max_height'];
	$thumb_size = $row['thumb_size'];
	$normal_size = $row['normal_size'];
	$thumb_cells = $row['thumb_cells'];
	$thumb_rows = $row['thumb_rows'];
	$search_suggestions = $row['search_suggestions'];
}

if ($installed == "") {
	header('Location: install/');
}


if(!isset($_SESSION["loggedIn"])) {
	//header("Location: login.php");
} else {
	$user_name = $_SESSION['username'];
	$user_id = $_SESSION['userid'];
	$user_level = $_SESSION['userlevel'];
	//$result = mysql_query("SELECT * FROM ".$prefix."users WHERE username = ".$user_name);
	//while($row = mysql_fetch_array($result)) {
		//$user_id = $row['id'];
		//$user_level = $row['user_level'];
		//$user_name = $row['username'];
		//echo "yesy";
	//}
}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title><?php echo $pagename; ?></title>
<?php
echo "<link href='template/$template' rel='stylesheet' type='text/css' />";
echo "<script type='text/javascript' src='include/jquery.min.js'></script>";
echo "<script type='text/javascript' src='include/search.js'></script>";
?>
</head>

<body>
<p align="center"><b><font size="6"><?php echo $pagename; ?></font></b><br>
<b><font size="4"><?php echo $slogan; ?></font></b></p>

<div align="center">
<table style="width:1024px">
	<tr>
		<td style="width:160px" valign="top">
			<?php include "include/leftside.php"; ?>
		</td>
		<td style="width:12px" valign="top">
		</td>
		<td style="width:680px" valign="top">
