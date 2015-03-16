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

	//function to create a post
	//returns true if success
	function create_post($uid, $title, $url, $type){
		$co = new Noni();
		if($co->create_post($uid, $title, $url, $type)){
			return true;
		}else{
			return false;
		}
	}

	//function to create a comment for a post
	//returns true if success
	function create_comment($uid, $pid, $comment){
		$co = new Noni();
		if($co->create_comment($uid, $pid, $comment)){
			return true;
		}else{
			return false;
		}
	}

	//function to edit a post
	//returns true if success
	function edit_post($pid){

	}

	//function to edit a comment
	//returns true if success
	function edit_comment($cid){

	}

	//function to delete a comment
	//returns true if success
	function delete_comment($cid){

	}

	//function to delete a post
	//returns true if success
	function delete_post($pid){

	}
}

/*
$test = new noniController();
print_r($test->get_all_post());
*/
?>