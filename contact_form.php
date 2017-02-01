<?php
require('include/header.php');

$query3 = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id=1");
while ($row3 = mysqli_fetch_array($query3)) {
	$my_email = $row3['email'];
}
?>


<script>
 function goBack()
   {
     window.history.back()
   }
 </script>
</head>

<body>

<?php
if (isset($_REQUEST['email'])) {
	//send email
	$email = $_REQUEST['email'] ;
	$subject = $_REQUEST['subject'] ;
	$message = $_REQUEST['message'] ;

	echo "<div align='center'><table class='table' width='680'>
		<tr class='table_header'>
			<td>Contact Form</td>
		</tr>
		<tr class='row1'>
			<td>";
				session_start();
				if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{
					if ($email || $subject || $message == "") {
						echo "<center><br>ERROR: you have to fill in all the fields<br><br>";
						echo "<input type='button' value='Back' onclick='goBack()' /><br><br>";
						echo "</center></td></tr></table></div>";
						include ("include/footer.php");
						exit;
					}
				mail($my_email, $subject,
				$message, "From:" . $email);
				echo "Thank you for using this form.<br>Your message has been send.";

				} else {  
					echo "<center>Oops, Wrong Captcha code.<br>Please try again.<br><br>";
					echo "<input type='button' value='Back' onclick='goBack()' /></center>";
				}


			echo "</td>
		</tr>
	</table></div>";
 
} else {

	echo "<div align='center'><form method='post' action='contact_form.php'>
		<table class='table' width='680'>
			<tr class='table_header'>
				<td colspan='3'>Contact Form</td>
			</tr>
			<tr class='row1'>
				<td>Email:</td>
				<td colspan='2'>
					<input name='email' type='text' />
				</td>
			</tr>
			<tr class='row2'>
				<td>Subject:</td>
				<td colspan='2'>
					<input name='subject' type='text' />
				</td>
			</tr>
			<tr class='row1'>
				<td valign='top'>Message:</td>
				<td colspan='2'>
					<textarea name='message' rows='8' cols='40'></textarea>
				</td>
			</tr>


			<tr class='row2'>
				<td><br>
					Captcha Code:<br>
				</td>
				<td width='98'>
					<input class='input' type='text' name='norobot' size='8' />
				</td>
				<td><br>
					<img src='include/captcha.php' /><br><br>
				</td>
			</tr>


			<tr class='row3'>
				<td>&nbsp;</td>
				<td colspan='2'>
					<input type='submit' value='Send Message' />
				</td>
			</tr>
		</table></div>
	</form>";
}



require('include/footer.php');
?>