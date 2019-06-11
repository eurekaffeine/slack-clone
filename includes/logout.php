<?php 
	session_start();
	session_destroy();
	// unset($_SESSION["userLoggedIn"]);
	header("Location: ../register.php");
 ?>