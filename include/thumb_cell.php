<?php



echo "<center>
<table class='thumb_cell' width='170' border'1'>
        <tr>
            <td><center><b>$img_name</b></center></td>
        </tr>
        <tr>
            <td>
		<center><a href='image.php?imgid=$img_id'><img border='0' src='uploads/thumbs/$img_filename'></center>
		</td>
        </tr>
        <tr>
		<td>
			<font size='1'>
				Date added: ".$img_date."<br>
				Resolution: ".$img_resolution."<br>
				Filesize: ".$img_filesize."<br>
				Added by: ".$img_uploader."<br>
				Rating: ".$img_average."<br>
				Views: ".$img_views."<br>
			</font>
		</td>
        </tr>
</table>
</center>";
?>