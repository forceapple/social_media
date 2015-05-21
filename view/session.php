<?php 
	//check if session started
	if(session_id() == '' && !isset($_SESSION)) {
    	session_start();
	}
	print_r($_SESSION);
?>