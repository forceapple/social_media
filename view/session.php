<?php 
	//check if session started
	if(session_id() == '' && !isset($_SESSION)) {
    	session_start();
	}
	
	if (isset($_SESSION['username'])) {
		$userId_session = $_SESSION['user_id'];
		$username = $_SESSION['username'];
		$profilePic = $_SESSION['profile_img'];
		$fname = $_SESSION['f_name'];
		$lname = $_SESSION['l_name'];
		$isLoggedIn = true;
	} else {
		$isLoggedIn = false;
		$userId_session = -1; // -1 means no user logged on
		$isUserFlag = false;		
	}
	//print_r($_SESSION);
?>