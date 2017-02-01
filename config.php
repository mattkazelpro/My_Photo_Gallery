<?php
//Begin Configuration

$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="personal_images"; // Database name
$prefix="mpg_"; // the name before the tables (handy when you have more then one installation in a database).

//end configuration

$version = "1.0";

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>