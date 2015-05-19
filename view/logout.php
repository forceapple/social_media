<?php
	$_SESSION['user'] = "1";
	print_r($_SESSION);
	session_destroy();

?>