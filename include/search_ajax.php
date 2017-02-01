<?php
require('../config.php');

	
if(isset($_POST['name'])) {
	$result = mysqli_query($conn, "SELECT * FROM ".$prefix."settings WHERE id = 1");
	while($row = mysqli_fetch_array($result)) {
		$search_suggestions = $row['search_suggestions'];
	}
	$name=trim($_POST['name']);
	$query2=mysqli_query($conn, "SELECT * FROM ".$prefix."images WHERE img_name LIKE '%$name%' OR img_desc LIKE '%$name%' AND img_active=1 LIMIT ".$search_suggestions);
	echo "<ul>";
	while($row2=mysqli_fetch_array($query2)) {
	?><li onclick='fill("<?php echo $row2['img_name']; ?>")'><?php echo $row2['img_name']; ?></li><?php
	}
}
echo "</ul>";
?>