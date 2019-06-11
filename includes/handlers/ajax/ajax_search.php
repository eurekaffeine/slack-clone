<?php
include("../../config.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$result1 = mysqli_query($con, "SELECT * FROM Workspace NATURAL JOIN UseWorkspace NATURAL JOIN User WHERE wname like '$query%' AND username = '$userLoggedIn' LIMIT 8");
$result2 = mysqli_query($con, "SELECT * FROM Channel WHERE channelName like '$query%' AND ctype = 'public' LIMIT 8");
$tempquery = "select *
					 from User natural join UseChannel natural join 
					 		(select cid, wid from User natural join UseChannel natural join Channel 
					 		where ctype = 'direct' and username = '$userLoggedIn') as A
					 where username like '$query%' LIMIT 8";
$result3 = mysqli_query($con, $tempquery);

if($query != ""){
// search content is about workspace	
	if(mysqli_num_rows($result1) > 0) {
		echo "<div class='resultDisplay'> Workspace </div>";
		while($row = mysqli_fetch_array($result1)) {
			echo "<div class='resultDisplay'>
					<a href='http://localhost:8080/slack/index.php?wid=" . $row['wid'] . "' style='color: #1485BD'>
						<span>" . $row['wname'] . "</span>
					</a>
					</div>";
		}		
	}
// search content is about channel	
	if($result2->num_rows > 0) {
		echo "<div class='resultDisplay'> Channel </div>";
		while($row = mysqli_fetch_array($result2)) {
			echo "<div class='resultDisplay'>
					<a href='http://localhost:8080/slack/index.php?wid=" . $row['wid'] ."&cid=". $row['cid'] . "' style='color: #1485BD'>
						<span>" . $row['channelName'] . "</span>
					</a>
					</div>";
		}		
	}

// search content is about friends(direct channel)
	if($result3->num_rows > 0) {
		echo "<div class='resultDisplay'> Friends </div>";
		while($row = mysqli_fetch_array($result3)) {
			echo "<div class='resultDisplay'>
					<a href='http://localhost:8080/slack/index.php?wid=" . $row['wid'] ."&cid=". $row['cid'] . "' style='color: #1485BD'>
						<span>" . $row['username'] . "</span>
					</a>
					</div>";
		}
	}

	if ($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {
		echo "<div class='resultDisplay'> There is no matched data </div>";
	}
}

?>