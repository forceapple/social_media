<?php
include('view/session.php'); //this has to be first
if(isset($_GET['_url'])){
	session_start();
	$params = explode("/", $_GET['_url']);
	if(isset($_GET['async'])){
		
		switch($params[0]){
			case "user":
				/*$_GET['mode'] = 1;
				include("server/user_listen.php");*/
				//$_GET['phase'] = 1;
				echo json_encode("Call on to the listener file");
			break;	

			case "post":

				//intercept post id
				if(is_int($params[1])){
					$_GET['phase'] = 1;
					$_GET['pid'] = $params[1];
					
				}			
				require_once('controller/listener.php');
			break;
		}	
		exit;
	}
	
	include('view/header.php');
	
	//check which page to show
	switch($params[0]){
		case "user":
			include("view/userPicture.php");
		break;

		case "hot":
			include("view/userPicture.php");
		break;

		case "post":
			$post_num = intval($params[1]);
			if($params[1]=="create"){
				require_once('view/newpost.php');
			}else{
				$_GET['phase'] = 1;
				$_GET['pid'] = $params[1];
				require_once("view/post.php");
			}
		break;
		case "edit":
			$_POST = array();
			$_POST['phase'] = 2;
			$_POST['pid'] = $params[1];
			require_once("view/updatepost.php");
		break;
		case "delete":
			print_r($params);
			$_POST['phase'] = 4;
			$_POST['pid'] = $params[1];
			require_once("view/deletepost.php");
		break;
		case "register":
			require_once("view/register.php");
		break;
		case "login":
			require_once("view/login.php");
		break;
		case "logout":
			if(isset($_SESSION['user_id'])){
				session_destroy();
				require_once("view/logout.php");
			}else{
				header('Location: '. ROOT_FOLDER);
			}
		break;
	}
	require_once('view/footer.php');
}else{
	include('view/header.php');
	require_once('view/front.php');
	require_once('view/footer.php');
}
?>