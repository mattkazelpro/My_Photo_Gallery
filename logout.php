<?php 
require('include/header.php');

//session_start();
 session_destroy();



echo "<table class='table' width='680'>
	<tr class='table_header'>
		<td>Login Status</td>
	</tr>
	<tr class='row1'>
		<td>You are succesfully logged out.</td>
	</tr>
</table>";




require('include/footer.php');
?>
