<?php
	include("../../config.php");
	if(isset($_SESSION['userLoggedIn'])) {
		$userLoggedIn = $_SESSION['userLoggedIn'];
	}
	if(isset($_POST['wid'])) {
		$wid = $_POST['wid'];
		$query = mysqli_query($con, "select cid, channelName from Channel NATURAL JOIN User NATURAL JOIN UseChannel where username = '$userLoggedIn' and wid =1");
		$resultArray = mysqli_fetch_array($query);	
		echo json_encode($resultArray);
	}
?>