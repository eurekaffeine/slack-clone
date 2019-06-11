<?php 
	include("config.php");
	echo $_POST['cid'];
	if(isset($_POST['toId']) && isset($_POST['cid']) && isset($_POST['username'])){
		$toId = $_POST['toId'];
		$cid = $_POST['cid'];
		$wid = $_POST['wid'];
		$username = $_POST['username'];
		$uidQ = mysqli_query($con, "SELECT uid from User WHERE username = '$username'");
		$uid = mysqli_fetch_array($uidQ)['uid'];
		mysqli_query($con, "INSERT INTO Invitation(fromId, toId, type, id, inviteTime, viewed, accepted) VALUES('$uid', '$toId', 'channel', '$cid',now(), 'NO', 'NO')");
		header("Location: ../index.php?wid=".$wid."&cid=".$cid);
	}else{
		$cid = $_POST['cid'];
		$wid = $_POST['wid'];
		header("Location: ../index.php?wid=".$wid."&cid=".$cid);
	}
 ?>