<?php
require_once('view/header.php');
if(isset($_GET['_url'])){
	
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
			}elseif(is_int($post_num)){
				echo count($params);
				print_r($params);
				if(array_key_exists(2, $params)){
					//there's a second parameter, check for edit / delete
					//echo array_key_exists(2, $params);
				}else{
					$_GET['phase'] = 1;
					$_GET['pid'] = $params[1];
					require_once("view/post.php");
				}
				
			}

		break;
	}
	require_once('view/footer.php');
}else{
	require_once('view/header.php');
	require_once('view/front.php');
	require_once('view/footer.php');
}
?>