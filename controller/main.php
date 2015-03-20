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
	function create_post($uid, $title, $text, $type){
		$co = new Noni();
		if($co->create_post($uid, $title, $text, $type)){
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
	function edit_post($pid, $uid, $title, $text, $type){
		$co = new Noni();
		if($co->edit_post($pid, $uid, $title, $text, $type)){
			return true;
		}else{
			return false;
		}
	}

	//function to edit a comment
	//returns true if success
	function edit_comment($pid,$uid, $cid, $comment){
		$co = new Noni();
		if($co->edit_comment($pid,$uid, $cid, $comment)){
			return true;
		}else{
			return false;
		}
	}

	//function to delete a comment
	//returns true if success
	function delete_comment($cid,$uid){
		$co = new Noni();
		if($co->del_comment($cid,$uid)){
			return true;
		}else{
			return false;
		}
	}

	//function to delete a post
	//returns true if success
	function delete_post($pid, $uid){
		$co = new Noni();
		if($co->del_post($pid, $uid)){
			return true;
		}else{
			return false;
		}
	}
}

/*
$test = new noniController();
print_r($test->get_all_post());
*/
?>