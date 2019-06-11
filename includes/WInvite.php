<?php 
	include("config.php");
	if(isset($_POST['toId']) && isset($_POST['wid']) && isset($_POST['username'])){
		$toId = $_POST['toId'];
		$wid = $_POST['wid'];
		// echo $wid;
		$username = $_POST['username'];
		$uidQ = mysqli_query($con, "SELECT uid from User WHERE username = '$username'");
		$uid = mysqli_fetch_array($uidQ)['uid'];
		mysqli_query($con, "INSERT INTO Invitation(fromId, toId, type, id, inviteTime, viewed, accepted) VALUES('$uid', '$toId', 'workspace', '$wid',now(), 'NO', 'NO')");
		header("Location: ../index.php?wid=".$wid);
	}else{
		$wid = $_POST['wid'];
		header("Location: ../index.php?wid=".$wid);
	}
 ?>