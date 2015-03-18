<?php
require('main.php');

// *******************
// GET PHASES
// *******************
// 0 - get all posts
// 1 - get post by user id
// 2 - get comments by post id

// *******************
// POST PHASES
// *******************
// 0 - create new post
// 1 - post new comment
// 2 - ?

// TO DO
// class constructor

$errors = array();
$data = array();

if(isset($_GET['phase'])){
	switch($_GET['phase']){
		case 0:
			$lo = new noniController();
			echo json_encode($lo->get_all_post());
		break;
		case 1:
			$lo = new noniController();
			echo json_encode($lo->get_post($_GET['pid']));
		break;
		case 2:
			$lo = new noniController();
			echo json_encode($lo->get_comments($_GET['cid']));
		break;
	}
}

if(isset($_POST['phase'])){
	switch ($_POST['phase']) {
		case 0:
			//check inputs
			if(empty($_POST['link_title'])){
				$error['title'] = 'Title is required';
			}elseif(empty($_POST['link_url'])){
				$error['url'] = 'URL is required';
			}
			if(!empty($errors)){
				$data['success'] = false;
				$data['errors'] = $errors;
			}else{
				$lo = new noniController();
				$lo->create_post($_POST['uid'], $_POST['title'], $_POST['url'], $_POST['type']);
				$data['success'] = true;
				$data['message'] = 'Success';
			}
			echo json_encode($data);
			break;
		
		case 1:
			if(empty($_POST['comment'])){
				$error['comment'] = 'Comment is required';
			}
			if(!empty($errors)){
				$data['success'] = false;
				$data['errors'] = $errors;
			}else{
				$lo = new noniController();
				$lo->create_comment($_POST['userID'], $_POST['postID'], $_POST['comment']);
				$data['success'] = true;
				$data['message'] = 'Success';
			}
			echo json_encode($data);
			break;

		default:
			return false;
			break;
	}
}


?>