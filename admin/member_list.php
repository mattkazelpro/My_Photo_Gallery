<?php
require('include/header.php');
$rowcount = 1;
$start=0;
$limit=10;
$id=1;

if(isset($_GET['id'])) {
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

//echo "test";
//echo $user_name;
//echo $user_level;

//=============================
//===Actions===================
//=============================
if (isset($_GET['action'])) {

	echo"<table class='table' width='100%'>
		<tr class='table_header'>
			<td>Action</td>
		</tr>
		<tr class='row1'>
			<td>Your Image is: ".$_GET['action']."</td>
		</tr>
	</table>
	<br>";

	if ($_GET['action']="deactivate") {
 		mysqli_query($conn, "UPDATE ".$prefix."images SET img_active=0 WHERE img_id=".$_GET['imgid']);
	}

	if ($_GET['action']="activate") {
 		mysqli_query($conn, "UPDATE ".$prefix."images SET img_active=1 WHERE img_id=".$_GET['imgid']);
	}
}
//=============================
//===End Actions===============
//=============================




	echo "<table class='table' width='100%' class='table'>
		<tr class='table_header'>
			<td colspan='5'>
				Members
			</td>
		</tr>
		<tr class='row3'>
			<td>Username</td>
			<td>E-Mail</td>
			<td>IP</td>
			<td>Level</td>
			<td>options</td>
		</tr>";


$query1 = mysqli_query($conn, "select * FROM ".$prefix."users ORDER BY id LIMIT $start, $limit");
while ($row1 = mysqli_fetch_array($query1)) {
	$id = $row1['id'];
	$username = $row1['username'];
	$email = $row1['email'];
	$ip = $row1['ip'];
	$user_level = $row1['user_level'];
	if ($user_level == 1) { $user_level="Member";}
	if ($user_level == 9) { $user_level="Admin";}


		echo "<tr class='row$rowcount'>
			<td>$username</td>
			<td>$email</td>
			<td><a target='_blank' href='http://whois.domaintools.com/$ip'>$ip</a></td>
			<td>$user_level</td>
			<td width='40'>
				<a href='member_edit.php?member_id=$id'><img width ='16' border='0' title='Edit Member' src='images/edit_icon.png'></a>
				<a href='member_delete.php?member_id=$id'><img width ='16' border='0' title='Delete Member' src='images/delete_icon.png'></a>
			</td>
		</tr>";

		$rowcount = $rowcount + 1;
		if ($rowcount == 3) {
			$rowcount = 1;
		}

}


//Pagination
echo "<tr class='row$rowcount'><td colspan='7'>";
$rows=mysqli_num_rows(mysqli_query($conn, "select * FROM ".$prefix."users"));
$total=ceil($rows/$limit);

if($id>1) {
	echo "<a href='?id=".($id-1)."' class='button'>PREVIOUS</a> - ";
}
if($id!=$total) {
	echo "<a href='?id=".($id+1)."' class='button'>NEXT</a> - ";
}


for($i=1;$i<=$total;$i++) {
	if($i==$id) {
		 echo $i." ";
	} else {
		echo "<a href='?id=".$i."'>".$i."</a> ";
	}
}
echo "</td></tr>";
//End Pagination




	echo "</table><br>";






//echo "</table>";



require('include/footer.php');
?>