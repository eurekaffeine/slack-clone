<?php
include("includes/config.php");
// include("includes/addChannel.php");
//session_destroy(); LOGOUT

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
	header("Location: register.php");
}


?>

<html>
  <head>
    <title>Welcome to Slack!</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet" type="text/css"/>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 <script src="assets/js/script.js"></script>


   <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="./index.css">

  </head>
<!-- <meta http-equiv="refresh" content="60"> -->
<!-- <script src="assets/js/index.js"></script> -->

  <body>  


    <div class="header">     
      <div class="team-menu">
        <a href="#addWorkspace" rel="modal:open" style="text-decoration: none;">
        <img class = "add" src='assets/images/icons/add.png' data-toggle="modal" data-target="#myModal" >
        </a>
        Workspace: 
      	<select class='selectWorkspace' onchange="self.location.href=options[selectedIndex].value">
      		<option value ="index.php">Choose one</option>
      		<?php 
				  $workspaceQuery = mysqli_query($con, "select wid, wname from User NATURAL JOIN Workspace NATURAL JOIN UseWorkspace where username = '$userLoggedIn'");
              while($row = mysqli_fetch_array($workspaceQuery)) {
                if (isset($_GET['wid']) && $_GET['wid']==$row['wid']) {
                    echo"
                    <option selected='selected' value='index.php?wid=".$row['wid']."'>".$row['wname']."
                    </option>
                  ";
                }else{
                  echo"
                    <option value='index.php?wid=".$row['wid']."'>".$row['wname']."
                    </option>
                  ";
                }
		          }
			    ?>
      	</select>
      </div>
      <div class="channel-menu">
      	<span class="channel-menu_name">
      		<span class="channel-menu_prefix">
            <?php 
              if (isset($_GET['cid'])) {
                $cid = $_GET['cid'];
                $ctQuery = mysqli_query($con, "select ctype from Channel where cid='$cid'");
                $row = mysqli_fetch_array($ctQuery);
                if ($row['ctype']=="private"){
                  echo "<img src='assets/images/icons/lock-black.png' style='width:23px;'>";
                }else if($row['ctype']=="public"){
                  echo "#";
                }
              }else{
                echo "";
              }
            ?>
          </span>
      		<?php 
            if (isset($_GET['cid'])) {
              $cid = $_GET['cid'];
              $cnQuery = mysqli_query($con, "select channelName,ctype from Channel where cid='$cid'");
              $row = mysqli_fetch_array($cnQuery);
              if($row['ctype'] == 'direct'){
                $query = mysqli_query($con, "SELECT username FROM User NATURAL JOIN UseChannel WHERE username !='$userLoggedIn' AND cid ='$cid'");
                echo mysqli_fetch_array($query)['username'];
              }else{
                echo $row['channelName'];
              }
            }else{
              echo "<span>Choose A Channel Or DirectMessage</span>";
            }
           ?>
      	</span>

        <!-- search -->
        <span class="search">
          <form action="#" method="GET" name="search_form">
            <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

            <div class="button_holder">
              <img src="assets/images/icons/magnifying_glass.png">
            </div>

          </form>

          <div class="search_results">
          </div>

          <div class="search_results_footer_empty">
          </div>
        </span>




        <span>
          <a href="#inviteWAC" rel="modal:open" style="text-decoration: none;">
            <img src="assets/images/icons/invite.png" style="width: 35px; float: right; margin-top: 10px;margin-right: 20px; 
            <?php if(!isset($_GET['wid']) || isset($_GET['c'])){
              echo"visibility: hidden;";
            } 
            ?>">
          </a>
        </span>
      </div>
    </div>




    <div class="main">
      <div class="listings">
        <div class="listings_channels">
          <h2 class="listings_header">Channels
            <a href="#addChannel" rel="modal:open">
              <?php 
                if(isset($_GET['wid'])){
                  echo "<img class = 'addin' src='assets/images/icons/add.png' data-toggle='modal' data-target='#myModal' >";
                } else{
                  echo "";
                }
              ?>
            </a>
          </h2>

          <ul class="channel_list">
          	<?php 
              if (isset($_GET['wid'])) {
                $wid = $_GET['wid'];
                $active = "";
  						  $channelQuery = mysqli_query($con, "select cid, ctype, channelName from Channel NATURAL JOIN User NATURAL JOIN UseChannel where username = '$userLoggedIn' and wid ='$wid'");
  						  while($row = mysqli_fetch_array($channelQuery)) {
                  if(isset($_GET['cid']) && $_GET['cid'] == $row['cid']){
                    $active = "active";
                  }else{
                    $active = "";
                }
                if($row['ctype']=='public'){
                echo "
                  <li class='channel ".$active."'>
                    <a class='channel_name' href='index.php?wid=".$wid."&cid=".$row['cid']."'style='color:#fff; text-decoration: none;'>
                      <span class='prefix'>
                        #
                      </span>
                      ".$row['channelName']."
                    </a>
                  </li>
                  ";
                } else if ($row['ctype']=='private'){
                  echo "
                    <li class='channel ".$active."'>
                      <a class='channel_name' href='index.php?wid=".$wid."&cid=".$row['cid']."'style='color:#fff;     text-decoration: none;'>
                        <span class='prefix'>
                           <img src='assets/images/icons/lock.png' style='height: 15px;margin-left: -4px;width: 15px;'>
                        </span>
                        ".$row['channelName']."
                      </a></li>";
                }   
						  }	
	          }
	        ?>
          
           
          </ul>
        </div>

        <div class="listings_direct-messages">
          <h2 class="listings_header">Direct Messages
            <a href="#addDirectMessage" rel="modal:open">
              <?php 
              if(isset($_GET['wid'])){
                  echo "<img class= 'addin' src='assets/images/icons/add.png' data-toggle='modal' data-target='#myModal' >
                        </a>";
              } else{
                echo "";
              }
              ?>
            </a>

          </h2>
          <ul class="channel_list">

            <?php 
              if(isset($_GET['wid'])) {
                $wid = $_GET['wid'];
                $sql="SELECT username, uid, cid, wid
                FROM UseChannel NATURAL JOIN Channel NATURAL JOIN User WHERE ctype = 'direct' AND username !='$userLoggedIn' AND wid='$wid' AND cid in (SELECT cid FROM User NATURAL JOIN Channel NATURAL JOIN UseChannel WHERE username = '$userLoggedIn')";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($res)) {
                  if(isset($_GET['cid']) && $_GET['cid'] == $row['cid']){
                    $active=" active";
                    $dot="-white";
                  }else{
                    $active="";
                    $dot="";
                  }
                        echo
                        "<li class='channel".$active."'>
                        <a href='index.php?wid=".$row['wid']."&cid=".$row['cid']."&c=0' class='channel_name' style='text-decoration: none;color: #fff;'>
                         <span class='prefix'>
                             <img src='assets/images/icons/dot".$dot.".png' style='height: 10px;margin-left: -4px;width: 10px;'>
                          </span>
                      "
                      .$row['username'].
                      "
                      </a>
                    </li>";
                    
              }
            }

             ?>


          </ul>
        </div>
      </div>

      <div class="message-history">

        <?php 
        if (isset($_GET['cid'])) {
          $cid = $_GET['cid'];
          // echo $cid;
          $messageQuery = mysqli_query($con, "SELECT username, uid, content, messageTime from Message NATURAL JOIN User natural join Channel WHERE cid ='$cid' and fromId = uId  order by messageTime asc");
            while($row = mysqli_fetch_array($messageQuery)) {
              if($row['username'] != $userLoggedIn) {
                echo "
                  <div class='message'>
                    <a class='message_profile-pic' href=''>
                    <img src='assets/images/profile-pics/avatar.png' style='height: 32px;width: 32px;'>
                    <a class='message_username' href=''>
                        ".$row['username']."
                    </a>
                    <span class='message_timestamp'>
                    ".$row['messageTime']."
                    </span>
                    <span class='message_content'>
                    ".$row['content']."
                    </span>
                  </div>
                ";
              }else{
                echo "
                  <div class='message' >
                    <a class='message_profile-pic' href=''>
                    <img src='assets/images/profile-pics/me.png' style='height: 32px;width: 32px;'>
                    <a class='message_username' href=''>
                        YOU
                    </a>
                    <span class='message_timestamp'>
                    ".$row['messageTime']."
                    </span>
                    <span class='message_content'>
                    ".$row['content']."
                    </span>
                  </div>
                ";
              }
            }
          }
          ?>  
    </div>



    <div class="footer">
      <div class="user-menu">
        <a href="#LOGOUT" rel="modal:open" class="user-menu_profile-pic">
          <img src="assets/images/profile-pics/me.png" style="width: 50px;">
        </a>
        <span class="user-menu_username">
          <?php echo $userLoggedIn ?>
        </span>
        <span class="connection_status">
          online
        </span>
        <!-- notification -->
        <?php 
            $query = mysqli_query($con, "SELECT * FROM Invitation NATURAL JOIN User WHERE viewed = 'NO' AND toId = uid AND username = '$userLoggedIn'");
            $num_invitations = mysqli_num_rows($query);
         ?>
        <span class="notification_icon">
          <a href="#invitation" rel="modal:open">
            <img src="assets/images/icons/notification.png" style="height:26px;">
          <?php
          if($num_invitations > 0)
           echo '<span class="unread unread_notification" id="num_invitations">' . $num_invitations . '</span>';
          ?>
          </a>
        </span>
      </div>
      <div class="input-box" 
        <?php  
            if(isset($_GET['cid'])) {
              echo"";
            }else{
              echo "style='visibility: hidden;'";
            }
              ?>
              >
          <form action="./includes/sendMessage.php" method="POST">
            <input class="input-box_text" type="text" name="messageContent"/>
          <input class="sendButton" type="image" src="assets/images/icons/send.png" style="width: 40px; height: 40px;margin-left: 5px;position: fixed;">
          <input type="hidden" name="wid" value=" 
          <?php if(isset($_GET['wid'])){
                  echo$wid;
                }else{
                  echo '-1';
                } ?> ">
          <input type="hidden" name="cid" value=" 
          <?php 
            if(isset($_GET['cid'])){
              echo $cid;
            } else{
              echo "-1";
            }
          ?> 
          ">
          </form>
      </div>
    </div>


<!-- modal htmls -->
<!-- for addChannel -->
    <div id="addChannel" class="modal">
      <div class="model-title">
        <h1>
          Create A Channel
        </h1>
      </div>
      
        <form action="./includes/addChannel.php" id ="addChannel" method="POST">
          <div> Channel Name:
          <input required type="text" name="channelName">
          </div>
          <!-- <div> Channel Descriptions:
          <input required type="text" name="channelDescription">
          </div> -->
          <div>Channel Type:
            <select name='ctype' from="addChannel" style='max-width: 150px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;'>
              <option value="public">public</option>
              <option value="private">private</option>
            </select>
          </div>
          <div>
            <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          </div>
          <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
          <input type="hidden" name="wid" value="<?php echo $wid; ?>">
        </form>
      
    </div>

<!-- for addDirectMessage -->
    <div id="addDirectMessage" class="modal">
      <div class="model-title">
        <h1>
          Send Direct Messages
        </h1>
      </div>
        <form action="./includes/addDirect.php" id ="addDirect" method="POST">
          
          
          <div>Find A Person:
            <select name='otherId' from="addDirect" style='max-width: 150px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;' > 
              <?php 
                $sql = "SELECT uid, username FROM User NATURAL JOIN UseWorkspace NATURAL JOIN Workspace WHERE wid='$wid' AND username != '$userLoggedIn'
                AND uid not in (SELECT DISTINCT(uid) FROM UseChannel WHERE cid in (SELECT cid from UseChannel NATURAL JOIN Channel NATURAL JOIN User WHERE ctype ='direct' AND username='$userLoggedIn' AND wid='$wid'))";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($res)) {
                  echo "<option value='".$row['uid']."'>
                ".$row['username']."
                  </option>";
                }
               ?>
               <!-- <option value="public">public</option> -->
            </select>
          </div>

          <div>
            <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          </div>
          <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
          <input type="hidden" name="wid" value="<?php echo $wid; ?>">
        </form>
    </div>

<!-- for invitation -->
    <div id="invitation" class="modal" style="max-width: 860px">
      <div class="model-title">
      <h1>
          Invitations
      </h1>
    </div>
      <div>
          <?php 
          $sql = "SELECT fromId, toId, type, id FROM Invitation NATURAL JOIN User WHERE viewed = 'NO' AND toId = uid AND username = '$userLoggedIn' ORDER BY inviteTime DESC";
          $res = mysqli_query($con, $sql);
          while($row = mysqli_fetch_array($res)) {
              $fromId = $row['fromId'];
              $xid = $row['id'];
              $type = $row['type'];
              $nameQuery = mysqli_query($con, "SELECT username FROM User WHERE uid ='$fromId'");
              $username = mysqli_fetch_array($nameQuery)['username'];
              if($type = "workspace") {
                $query = mysqli_query($con, "SELECT wname FROM Workspace WHERE wid = '$xid'");
                $xname = mysqli_fetch_array($query)['wname'];
              }else if($type = "channel") {
                $query = mysqli_query($con, "SELECT wname FROM Workspace WHERE cid = '$xid'");
                $xname = mysqli_fetch_array($query)['wname'];
              }else{
                $query = mysqli_query($con, "SELECT wname FROM Workspace WHERE wid = '$xid'");
                $xname = mysqli_fetch_array($query)['wname'];
              }
              echo "<div class = invitation>
                     <span class=invitation_line>".
                          $username. " send you a Invitation to " . $row['type'] .": ". $xname .
                      "</span>
                      <form action='./includes/invitation.php' id ='invitation' method='POST' class='notification_button'>
                        <select name='acceptance' from='invitation'>
                          <option value='Accept'>Accept</option>
                          <option value='Ignore'>Ignore</option>
                        </select>
                        <input type='submit' name='submit' value='OK' style='margin: 20px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
                        
                        <input type='hidden' name='toId' value=" . $row['toId'] .">
                        <input type='hidden' name='fromId' value=" . $row['fromId'] .">
                        <input type='hidden' name='type' value=" . $row['type'] .">
                        <input type='hidden' name='id' value=" . $row['id'] .">

                      </form>
                  </div>";


          }
          ?>
      </div>
    </div>

<!-- for add a workspace -->
    <div id="addWorkspace" class="modal">
        <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Create You Own Workspace
          </h1>
        </div>
        <form action="./includes/addWorkspace.php" id ="addDirect" method="POST">
          <div>
            Workspace Name:
            <input type="text" name="wname" required>
          </div>
          <div>
            Workspace Descriptions:
            <input type="text" name="wDes" required>
          </div>
          <div>
            <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          </div>
          <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
        </form>
    </div>


    <!-- for inviting people into workspace, administration or channel -->
    <div id="inviteWAC" class="modal">
      <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Invite Others Into Your Zone 
          </h1>
          <select class="form-control" id="WAC" style="max-width: 350px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;">
            <option selected='selected' value="">Please Select</option>
            <option value="W">Workspace Invitation</option>
            <option value="A">Workspace Administration Invitation</option>
            <?php 
              if(isset($_GET['cid'])) {
                echo "<option value='C'> Channel Invitation</option>";
              }
             ?>
          </select>
        </div>
    </div>

    <div id="inviteW" class="modal">
      <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Invite Others Into A Workspace
          </h1>
      </div>
          <form action="./includes/WInvite.php" id ="WInvite" method="POST">
          <div> Select A User to Send the Invitation:
            <select from="WInvite" name='toId' style="max-width: 150px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;">
              <?php 
                $wid = $_GET['wid'];
                $sql = "SELECT uid, username 
                FROM User 
                WHERE username !='$userLoggedIn' AND uid not in 
                (SELECT toId FROM Invitation WHERE type='workspace' AND id='$wid') AND uid not in (SELECT uid FROM UseWorkspace WHERE wid='$wid')";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($res)) {
                  $uid = $row['uid'];
                  echo"
                  <option value='$uid'>".$row['username']."</option>
                  ";
                }
               ?>
            </select>
          </div>
          <div>
          <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          </div>
          <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
          <input type="hidden" name="wid" value="<?php echo $wid; ?>">
        </form>
    </div>

    <div id="inviteA" class="modal">
      <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Give A User the permission of Administration
          </h1>
      </div>
          <form action="./includes/AInvite.php" id ="AInvite" method="POST">
          <div> Select A User to Send the Invitation:
            <select from="AInvite" name='toId' style="max-width: 150px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;">
              <?php 
                $wid = $_GET['wid'];
                $sql = "SELECT uid, username 
                FROM User 
                WHERE username!='$userLoggedIn' AND uid not in 
                (SELECT toId FROM Invitation WHERE type='administration' AND id='$wid') AND uid in 
                (SELECT uid FROM UseWorkspace WHERE wid = '$wid')
                AND uid not in (SELECT uid FROM Administration WHERE wid='$wid')";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($res)) {
                  $uid = $row['uid'];
                  echo"
                  <option value='$uid'>".$row['username']."</option>
                  ";
                }
               ?>
            </select>
            <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
          <input type="hidden" name="wid" value="<?php echo $wid; ?>">
          </div>
          <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          </div>
        </form>
      </div>
          
    </div>

    <div id="inviteC" class="modal">
      <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Invite Other Users Into A Channel
          </h1>
      </div>
      <form action="./includes/CInvite.php" id ="CInvite" method="POST">
          <div> Select A User to Send the Invitation:
            <select from="CInvite" name='toId' style="max-width: 150px; margin-top: 4px;height: 20px;background-color: #4c9689;color:#fff;border: transparent;border-radius: 0.05em;font:inherit;">
              <?php 
                $wid = $_GET['wid'];
                $cid = $_GET['cid'];
                $sql = "SELECT uid, username 
                FROM User 
                WHERE username!='$userLoggedIn' AND uid not in 
                (SELECT toId FROM Invitation WHERE type='channel' AND id='$cid') AND uid in 
                (SELECT uid FROM UseWorkspace WHERE wid = '$wid') AND uid not in 
                (SELECT uid FROM UseChannel WHERE cid = '$cid')";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($res)) {
                  $uid = $row['uid'];
                  echo"
                  <option value='$uid'>".$row['username']."</option>
                  ";
                }
               ?>
            </select>
          </div>
          <input type="submit" name="submit" style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>
          <input type="hidden" name="username" value="<?php echo $userLoggedIn; ?>">
          <input type="hidden" name="cid" value="<?php echo $cid; ?>">
          <input type="hidden" name="wid" value="<?php echo $wid; ?>">
        </form>

    </div>


    <div id="LOGOUT" class="modal">
       <div class="model-title">
          <h1 style=" text-align: center;font-weight: 800;padding: 10px 10px 20px 20px;">
              Are you Sure to Log out?
          </h1>
          <a href="./includes/logout.php">
            <button style='margin: 20px 192px 10px; background-color: #4c9689; font-size: 15px;border-radius: 5px;border: transparent;color: #fff;'>Logout</button>
          </a>
          
      </div>
    </div>

    <script type="text/javascript">
      $(function(){
        var totalHeight = 0;
        $('.message-history>div').each(function(index,ele){
          totalHeight += $(ele).outerHeight(true);
        });
        $('.message-history').scrollTop(totalHeight);
      });

      $(document).ready(function(){ //Make script DOM ready
        $('#WAC').change(function() { //jQuery Change Function
            var opval = $(this).val(); //Get value from select element
            if(opval=="W"){ //Compare it and if true
              $('#inviteW').modal("show"); //Open Modal
            }
            else if(opval=="A"){
              $('#inviteA').modal("show");
            }
            else if(opval=='C'){
              $('#inviteC').modal("show");
            }
        });
      });
    </script>


  </body>
</html> 




