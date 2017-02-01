		</td>
		<td style="width:12px" valign="top">
		</td>
		<td style="width:160px" valign="top">
			<?php include "include/rightside.php"; ?>
		</td> 
	</tr>
</table>
</div>


<p align="center"><br>

<?php
$sql = "UPDATE ".$prefix."settings SET hitcounter=hitcounter+1 WHERE id=1";
	if (!mysqli_query($conn, $sql)) {
		die('Error: ' . mysql_error());
	}

$arr1 = str_split($hitcounter);
foreach ($arr1 as $arr1) {
	echo "<img border='0' src='counterimages/$hitcounterimg/$arr1.gif'>";
}
?>
<br><br>
<a href="index.php">Home</a> | 
<a href="contact_form.php">Contact Webmaster</a> | 
<a href="admin/index.php">Admin Panel</a>
<br><br>
Powered by <a href="http://software.friendsinwar.com" class="copyright">My Photo Gallery</a> © 2017 Friends in War Software
</p>

</body>

</html>
