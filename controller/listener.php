<?php
require('main.php');

// *******************
// GET PHASES
// *******************
// 0 - get all posts
// 1 - get post by post id
// 2 - get comments by post id
// 3 - delete post by post id
// 4 - delete comment by comment id

// *******************
// POST PHASES
// *******************
// 0 - create new post
// 1 - post new comment
// 2 - edit post by post id
// 3 - edit comment by comment id

// TO DO
// class constructor

//REMINDER OF POST TYPES
//post type 0 = title and URL only
//post type 1 = title image URL a link
//post type 2 = title and text only


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
		case 3:
			$lo = new noniController();
			if($lo->delete_post($_GET['pid'], $_GET['uid'])){
				$data['success'] = true;
				$data['message'] = 'Success';
			}else{
				$data['success'] = false;
				$data['errors'] = 'Error';
			}
			echo json_encode($data);
			break;
		case 4:
			$lo = new noniController();
			if($lo->delete_comment($_GET['cid'], $_GET['uid'])){
				$data['success'] = true;
				$data['message'] = 'Success';
			}else{
				$data['success'] = false;
				$data['errors'] = 'Error';
			}
			echo json_encode($data);
			break;

	}
}

if(isset($_POST['phase'])){
	switch ($_POST['phase']) {
		case 0:
			//check inputs
			if(empty($_POST['title'])){
				$errors['title'] = 'Title is required';
			}elseif(empty($_POST['link_url'])){
				$errors['url'] = 'URL is required';
			}elseif(empty($_POST['type'])){
				$errors['type'] = 'Please select the post type';
			}elseif(empty($_POST['text'])){
				$errors['text'] = 'Text is required';
			}
			if(!empty($errors)){
				$data['success'] = false;
				$data['errors'] = $errors;
			}else{
				$lo = new noniController();
				$lo->create_post($_POST['uid'], $_POST['title'], $_POST['text'], $_POST['url'], $_POST['type']);
				$data['success'] = true;
				$data['message'] = 'Success';
			}
			echo json_encode($data);
			break;
		
		case 1:
			if(empty($_POST['comment'])){
				$errors['comment'] = 'Comment is required';
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
		case 2:
			if(empty($_POST['title'])){
				$errors['title'] = 'Title is required';
			}elseif(empty($_POST['url'])){
				$errors['url'] = 'URL is required';
			}elseif(empty($_POST['type'])){
				$errors['type'] = 'Please select the post type';
			}elseif(empty($_POST['text'])){
				$errors['text'] = 'Text is required';
			}
			if(!empty($errors)){
				$data['success'] = false;
				$data['errors'] = $errors;
			}else{
				$lo = new noniController();
				$lo->edit_post($_POST['pid'],$_POST['uid'],$_POST['title'], $_POST['text'], $_POST['url'], $_POST['type']);
				$data['success'] = true;
				$data['message'] = 'Success';
			}
			echo json_encode($data);
			break;
		case 3:
			if(empty($_POST['comment'])){
				$errors['comment'] = 'Comment is required';
			}
			if(!empty($errors)){
				$data['success'] = false;
				$data['errors'] = $errors;
			}else{
				$lo = new noniController();
				$lo->edit_comment($_POST['pid'],$_POST['uid'],$_POST['cid'],$_POST['comment']);
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