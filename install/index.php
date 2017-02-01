<?php
require('../config.php');

$script_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$script_url = str_replace("index.php", "", $script_url);
$script_url = str_replace("install/", "", $script_url);
$installed = 0;
$dir_uploads = '../uploads';
$dir_orginal = '../uploads/orginal';
$dir_thumbs = '../uploads/thumbs';
$go = 1;
?>

<html>

    <head>
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>My Photo Gallery - Setup</title>
        <link href="../template/basic.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div align="center">

            <?php
            if (isset($_POST['submit'])) {
                echo "<table class='table'>
		<tr class='table_header'>
			<td colspan='2'>Setup - Results</td>
		</tr>
		<tr class='row3'>
			<td width='300' colspan='2'>";
                include ('sql.php');
                echo "<b><center><br>My Photo Gallery is installed correctly.<br><br>
				You can now go to the admin panel:<br>
				<a href='../admin/index.php'>Admin Panel</a><br>
				Username = $username<br>Password = $password<br><br>
				<a href='../index.php'>My Photo Gallerie</a><br><br><br>
				Please delete the 'install' folder for security reasons.</center></b>



			</td>
		</tr>
	</table>";
                exit;
            }
            ?>



            <table class="table">
                <tr class="table_header">
                    <td colspan="2">Setup - Database settings</td>
                </tr>
                <tr class="row1">
                    <td width="150">Hostname:</td>
                    <td width="150"><b><?php echo $host; ?></b></td>
                </tr>
                <tr class="row1">
                    <td width="150">DB Username:</td>
                    <td width="150"><b><?php echo $username; ?></b></td>
                </tr>
                <tr class="row1">
                    <td width="150">DB Password:</td>
                    <td width="150"><b>********</b></td>
                </tr>
                <tr class="row1">
                    <td width="150">DB Name:</td>
                    <td width="150"><b><?php echo $db_name; ?></b></td>
                </tr>
                <tr class="row1">
                    <td width="150">DB Prefix:</td>
                    <td width="150"><b><?php echo $prefix; ?></b></td>
                </tr>
                <tr class="row1">
                    <td width="300" colspan="2">
                        <p align="center">

                            <?php
//                            $sql= "SELECT * FROM " . $prefix . "settings WHERE id = 1";
//                            $result = mysqli_query($conn, $sql);
//                            if (!$result) {
//                                die(mysql_error() . "SQL query error: " . $sql);
//                            } else {
//
//
//                                while ($row = mysqli_fetch_array($result)) {
//                                    if ($row['installed'] == 1) {
//                                        echo "<b>My Photo Gallery already exist with prefix: <br><u>" . $prefix . "</u><br><br>
//						Please choose a other prefix.</b>";
//                                        exit;
//                                    }
//                                }
//                            }
                            echo "</p></td></tr><tr class='row2'><td colspan='2'><b><center>Directories with writing permission:</center></b><p style='padding-right:40px;' align='right'>";
                            if (is_writable($dir_uploads)) {
                                echo '"/uploads" <font color="green">is writable</font><br>';
                            } else {
                                echo '"/uploads" <font color="red">is not writable</font><br>';
                                $go = 0;
                            }

                            if (is_writable($dir_orginal)) {
                                echo '"/uploads/orginal" <font color="green">is writable</font><br>';
                            } else {
                                echo '"/uploads/orginal" <font color="red">is not writable</font><br>';
                                $go = 0;
                            }

                            if (is_writable($dir_thumbs)) {
                                echo '"/uploads/thumbs" <font color="green">is writable</font>';
                            } else {
                                echo '"/uploads/thumbs" <font color="red">is not writable</font>';
                                $go = 0;
                            }

                            echo "</p><br></td></tr><tr class='row1'><td colspan='2'><p align='center'>";

                            if ($go == 0) {
                                echo "<b>Give the red directories<br>writing permissions (CHMOD 777).</b>";
                                exit;
                            } else {
                                echo "<b>Connection with the database is made.<br>We can install My Photo Gallery.</b>";
                            }
                            ?>
                        </p><br></td>
                </tr>

                <tr class="row2">
                    <td width="300" colspan="2">
                        <form method='post' action='index.php'>

                            <table border="0" width="100%" cellspacing="0" cellpadding="0">

                                <tr class="row2">
                                    <td>Website Name:</td>
                                    <td>
                                        <input type="text" name="pagename" size="20" value="My Photo Gallery">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td>Website Slogan:</td>
                                    <td>
                                        <input type="text" name="slogan" size="20" value="My beautiful pictures">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td>Username:</td>
                                    <td>
                                        <input type="text" name="username" size="20" value="Admin">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td>password:</td>
                                    <td>
                                        <input type="text" name="password" size="20" value="">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td>Your E-Mail:</td>
                                    <td>
                                        <input type="text" name="email" size="20" value="your@email.com">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td>Script URL:</td>
                                    <td>
                                        <input type="text" name="script_url" size="20" value="<?php echo $script_url; ?>">
                                    </td>
                                </tr>

                                <tr class="row2">
                                    <td><p align="center"></p></td>
                                </tr>

                                <tr class="row3">
                                    <td colspan="2">
                                        <p align="center"><br>
                                        <input type='submit' name='submit' value='Install'><br><br></td>
                                    </form>
                                </tr>
                            </table>
                    </td>
                </tr>
            </table>
        </div>