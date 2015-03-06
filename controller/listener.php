<?php
require('main.php');

// *******************
// GET PHASES
// *******************
// 0 - get all posts
// 1 - get post by user id
// 2 - get comments by post id

// TO DO
// class constructor


if(isset($_GET['phase'])){
	switch($_GET['phase']){
		case 0:
			$lo = new noniController();
			echo json_encode($lo->get_all_post());
		break;
		case 1:
			$lo = new noniController();
			echo json_encode($lo->get_post($_GET['uid']));
		break;
		case 2:
			$lo = new noniController();
			echo json_encode($lo->get_comments($_GET['cid']));
		break;
	}
}


?>