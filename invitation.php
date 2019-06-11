<?php 

	include("includes/config.php");

 ?>
<html>
	<title>Invitation</title>
	<head>
		
	</head>
	<body>
		<?php 
			$inviteQuery = mysqli_query($con, "SELECT fromId, wid FROM workspaceinvitation WHERE toId = '1'");
			$row = mysqli_fetch_array($inviteQuery);
			$fromId = $row['fromId'];
			$wid = $row['wid'];
		 ?>

		<div id = 'workspaceInvitation'>
			<?php 
				if(isset())

			 ?>
		</div>



	</body>
</html>