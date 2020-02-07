<?php
	session_start();
	if(isset($_SESSION['user_type'])){
		// user already loggedIn ==> logging him out
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit();
	
	}else{
		// no user loggedIn
		header("Location: index.php");
		exit();
	}

?>