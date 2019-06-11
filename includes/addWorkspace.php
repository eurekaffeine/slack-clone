<?php 

	include("./config.php");
	if(isset($_POST['wname']) && isset($_POST['wDes']) && isset($_POST['username'])){
		$wname = $_POST['wname'];
		$wDes = $_POST['wDes'];
		$username = $_POST['username'];
		// echo $username;
		$uidquery = mysqli_query($con, "SELECT uid FROM User WHERE username='$username'");
		$uid = mysqli_fetch_array($uidquery)['uid'];
		$insertQuery = mysqli_query($con, "INSERT INTO Workspace (wid, wname, description, wcreatorId, wcreateTime) VALUES ('', '$wname', '$wDes', '$uid', now())");
		// echo "INSERT INTO Workspace (wid, wname, description, wcreatorId, wcreateTime) VALUES ('', '$wname', '$wDes', '$uid', now())";
		$widQ = mysqli_query($con, "SELECT MAX(wid) as wid FROM Workspace");
		$wid = mysqli_fetch_array($widQ)['wid'];
		mysqli_query($con, "INSERT INTO UseWorkspace(wid, uid, wjointime) VALUES ('$wid', '$uid', now())");
		mysqli_query($con, "INSERT INTO Administration (wid, uid, adminTime) VALUES ('$wid,', '$uid', now())");
		header("Location: ../index.php?wid=".$wid);

	}

 ?>