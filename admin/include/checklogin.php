<?php
// checkLogin.php

session_start(); // Start a new session
require('../../config.php'); // Holds all of our database connection information

mysqli_connect("$host", "$username", "$password")or die("cannot connect to the database."); 
mysqli_select_db("$db_name")or die("cannot select the database.");

$result = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id = 1");
while($row = mysqli_fetch_array($result)) {
	$pagename = $row['pagename'];
	$template = $row['template'];
}

// Get the data passed from the form
$username = $_POST['username'];
$password = md5($_POST['password']);

// Do some basic sanitizing
$username = stripslashes($username);
$password = stripslashes($password);

$sql = "select * from ".$prefix."users where username = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql) or die ( mysqli_error() );

$count = 0;

while ($line = mysqli_fetch_assoc($result)) {
	$result = mysqli_query($conn, "SELECT * FROM ".$prefix."users WHERE username = '$username'");
	while($row = mysqli_fetch_array($result)) {
		$user_level = $row['user_level'];
		$user_name = $row['username'];
	}
	if ($user_level == 9) {
		$count++;
	}
}

if ($count == 1) {
	$_SESSION['username'] = $user_name;
	$_SESSION['userlevel'] = $user_level;
	$_SESSION['loggedIn'] = "true";
	 header("Location: ../index.php"); // This is wherever you want to redirect the user to
} else {
	$_SESSION['loggedIn'] = "false";
	header("Location: ../index.php?login=fail"); // Wherever you want the user to go when they fail the login
}

?>
