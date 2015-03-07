<?php
require_once('../model/main.php');

class noniController{

	//function to get all posts from the db
	//returns an array of posts
	function get_all_post(){
		$co = new Noni();
		return $co->get_all_post();
	}

	//function to get post by user id
	//returns a single array
	function get_post($uid){
		$co = new Noni();
		return $co->get_post($uid);
	}

	//function to get comments by post id
	//returns an array of comments
	function get_comments($pid){
		$co = new Noni();
		return $co->get_comments($pid);
	}

}

/*
$test = new noniController();
print_r($test->get_all_post());
*/
?>