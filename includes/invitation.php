<?php 

include("config.php");

$acceptance=$_POST['acceptance'];
$fromId = $_POST['fromId'];
$toId=$_POST['toId'];
$type = $_POST['type'];
$id = $_POST['id'];


if ($acceptance == 'Accept') {
	if ($type == 'workspace') {
		mysqli_query($con, "INSERT INTO UseWorkspace (wid, uid, wjointime) VALUES ('$id', '$toId', now())");
	} else if ($type == 'channel') {
		mysqli_query($con, "INSERT INTO UseChannel (cid, uid, cjointime) VALUES ('$id', '$toId', now())");
	} else {
		mysqli_query($con, "INSERT INTO Administration (wid, uid, ajointime) VALUES ('$id', '$toId', now())");
	}
	$query1 = "UPDATE Invitation SET viewed = 'YES' WHERE fromId = '$fromId' AND toId = '$toId' AND type = '$type' AND id = '$id'";
	mysqli_query($con, $query1);
	$query2 = "UPDATE Invitation SET accepted = 'YES' WHERE fromId = '$fromId' AND toId = '$toId' AND type = '$type' AND id = '$id'";
	mysqli_query($con, $query2);
} else {
	$query = "UPDATE Invitation SET viewed = 'YES' WHERE fromId = '$fromId' AND toId = '$toId' AND type = '$type' AND id = '$id'";
	mysqli_query($con, $query);
}


header("Location: ../index.php");

?>