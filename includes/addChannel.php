<?php 
	include("config.php");
	$ctype=$_POST['ctype'];
	$wid =$_POST['wid'];
	$cname=$_POST['channelName'];
	$username=$_POST['username'];
	// $cDes = $_POST['channelDescription'];
	$uIdQuery = mysqli_query($con, "SELECT uid FROM User WHERE username = '$username'");
        $row = mysqli_fetch_array($uIdQuery);
        $uid = $row['uid'];
    //Insert into Channel
	mysqli_query($con, "INSERT INTO Channel (cid, wid, channelName, ctype, ccreatorId, ccreateTime) VALUES ('', '$wid', '$cname', '$ctype', '$uid', now())");

	//Check cid
	$cidQuery = mysqli_query($con, "SELECT cid FROM Channel WHERE wid ='$wid' and channelName = '$cname'");
        $row = mysqli_fetch_array($cidQuery);
        $cid = $row['cid'];
    //Insert into UseChannel
    mysqli_query($con, "INSERT INTO UseChannel (cid, uid, cjointime) VALUES ('$cid','$uid', now())");

	header("Location: ../index.php?wid=".$wid);
 ?>