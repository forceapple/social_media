<?php
require_once('../model/main.php');

class noniController{

	//function to get all posts from the db
	//returns an array of posts
	function get_all_post($page){
		$co = new post_model();
		return $co->get_all_post($page);
	}

	//function to get post by post id
	//returns a single array
	function get_post($uid){
		$co = new post_model();
		return $co->get_post($uid);
	}

	//function to get comments by post id
	//returns an array of comments
	function get_comments($pid){
		$co = new comments_model();
		return $co->get_comments($pid);
	}

	//function to create a post
	//returns true if success
	function create_post($uid, $title, $text, $type){
		$co = new post_model();
		if($co->create_post($uid, $title, $text, $type)){
			return true;
		}else{
			return false;
		}
	}

	//function to create a comment for a post
	//returns true if success
	function create_comment($uid, $pid, $comment){
		$co = new comments_model();
		if($co->create_comment($uid, $pid, $comment)){
			return true;
		}else{
			return false;
		}
	}

	//function to edit a post
	//returns true if success
	function edit_post($pid, $uid, $title, $text, $type){
		$co = new post_model();
		if($co->edit_post($pid, $uid, $title, $text, $type)){
			return true;
		}else{
			return false;
		}
	}

	//function to edit a comment
	//returns true if success
	function edit_comment($pid,$uid, $cid, $comment){
		$co = new comments_model();
		if($co->edit_comment($pid,$uid, $cid, $comment)){
			return true;
		}else{
			return false;
		}
	}

	//function to delete a comment
	//returns true if success
	function delete_comment($cid){
		$co = new comments_model();
		if($co->del_comment($cid)){
			return true;
		}else{
			return false;
		}
	}

	//function to delete a post
	//returns true if success
	function delete_post($pid){
		$co = new post_model();
		if($co->del_post($pid)){
			return true;
		}else{
			return false;
		}
	}

	function vote_post($uid, $pid, $votetype){
		$co = new votes_model();
		if($co->vote_post($uid, $pid, $votetype)){
			return true;
		}else{
			return false;
		}	
	}

	function get_votes_by_post_id($pid){
		$co = new votes_model();
		return $co->get_votes_by_post_id($pid);
	}

	function login_user($username, $password){
		$co = new user_model($username, $password);
		return $co->login();
	}

	function register_user($username, $pass, $profile_img, $email, $f_name, $l_name, $location){
		$co = new user_register_model($username, $pass, $profile_img, $email, $f_name, $l_name, $location);
		return $co->register_user();
	}

	function search_post($input){
		$co = new search_model();
		return $co->search_post($input);
	}
	function search_user($input){
		$co = new search_model();
		return $co->search_user($input);
	}
	function search_name($input){
		$co = new search_model();
		return $co->search_name($input);
	}
	function search_comment($input){
		$co = new search_model();
		return $co->search_comment($input);
	}


	function fav_post($pid, $uid){
		$co = new fav_model();
		return $co->fav_post($pid, $uid);
	}

	function vote_comment($uid, $cid, $votetype){
		$co = new comment_votes_model();
		if($co->vote_comment($uid, $cid, $votetype)){
			return true;
		}else{
			return false;
		}	
	}
	
	function get_votes_by_comment_id($cid){
		$co = new comment_votes_model();
		return $co->get_votes_by_commnet_id($cid);
	}

	function get_saved_by_user_id($uid){
		$co = new fav_model();
		return $co->get_all_fav_by_uid($uid);
	}
}

// $test = new noniController();
// $test->get_votes_by_comment_id($b);
//print_r($test->register_user("test2", "1234", "google.ca", "g@g.g", "Gordo", "Broro", "Vancouver"));

?>