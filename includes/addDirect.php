<?php 
	include("config.php");
	$wid =$_POST['wid'];
	$otherId = $_POST['otherId'];
	$username=$_POST['username'];
	$uIdQuery = mysqli_query($con, "SELECT uid FROM User WHERE username = '$username'");
    $row = mysqli_fetch_array($uIdQuery);
    $uid = $row['uid'];
    //Insert into Channel
    mysqli_query($con, "INSERT INTO Channel (cid, wid, channelName, ctype, ccreatorId, ccreateTime) VALUES ('', '$wid', 'directM', 'direct', '$uid', now())");
    //Check cid
	$cidQuery = mysqli_query($con, "SELECT cid from Channel where ctype='direct' order by ccreateTime Desc LIMIT 1");
    $row = mysqli_fetch_array($cidQuery);
    $cid = $row['cid'];
    echo $cid;
    // Insert creator into UseChannel
    mysqli_query($con, "INSERT INTO UseChannel (cid, uid, cjointime) VALUES ('$cid','$uid', now())");
    // Insert receiver into UseChannel;
    mysqli_query($con, "INSERT INTO UseChannel (cid, uid, cjointime) VALUES ('$cid','$otherId', now())");
    header("Location: ../index.php?wid=".$wid."&cid=".$cid);
 ?>