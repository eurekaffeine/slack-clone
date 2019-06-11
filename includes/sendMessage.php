<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<?php
    header('content-type:text/html;charset=utf-8');
	include("config.php");
    if(!empty($_POST['messageContent']) && $_POST['cid']!='-1'){
        $userLoggedIn = $_SESSION['userLoggedIn'];
        $content = $_POST['messageContent'];
        $cid = $_POST['cid'];
        $wid = $_POST['wid'];
        $wid = str_replace(array(" ","　","\t","\n","\r"), '', $wid);
        $cid = str_replace(array(" ","　","\t","\n","\r"), '', $cid); 

        // Prevent injection
        $wid = mysqli_real_escape_string($con, $wid);
        $cid = mysqli_real_escape_string($con, $cid);
        $content = mysqli_real_escape_string($con, $content);
        $userLoggedIn = mysqli_real_escape_string($con, $userLoggedIn);

        $uIdQuery = mysqli_query($con, "SELECT uid FROM User WHERE username = '$userLoggedIn'");
        $row = mysqli_fetch_array($uIdQuery);
        $uid = $row['uid'];
        echo "INSERT INTO Message(mid, cid, mtype, fromId, content, messageTime) VALUES ('', '$cid', 'text', '$uid', '$content', now()) ";
        $res = mysqli_query($con, "INSERT INTO Message(mid, cid, mtype, fromId, content, messageTime) VALUES ('', '$cid', 'text', '$uid', '$content', now()) ");

        $url = "../index.php?wid=".$wid."&cid=".$cid;
        $url = str_replace(array(" ","　","\t","\n","\r"), '', $url); 
        header("Location: ".$url);
    }else{
        if($_POST['cid']!='-1'){
            $cid = $_POST['cid'];
            $cid = str_replace(array(" ","　","\t","\n","\r"), '', $cid);
            $wid = $_POST['wid'];
            $url = "../index.php?wid=".$wid."&cid=".$cid;
            $url = str_replace(array(" ","　","\t","\n","\r"), '', $url); 
            header("Location: ".$url);
        }else{
             header("Location: ../index.php");
        }
    }
 

    // if(!empty($_POST['messageContent']) && $_POST['cid']!='-1' && $_POST['wid']!='-1'){
    //     $userLoggedIn = $_SESSION['userLoggedIn'];
    //     $content = $_POST['messageContent'];
    //     $cid = $_POST['cid'];
    //     $wid = $_POST['wid'];
    //     $uIdQuery = mysqli_query($con, "SELECT uid FROM User WHERE username = '$userLoggedIn'");
    //     $row = mysqli_fetch_array($uIdQuery);
    //     $uid = $row['uid'];
    //     $InsertQuery = mysqli_query($con, "INSERT INTO Message(mid, cid, mtype, fromId, content, messageTime) VALUES ('', '$cid', 'text', '$uid', '$content', now()) ");
        
    //     header("Location: ../index.php");
    // }
   
?>