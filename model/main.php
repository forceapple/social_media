<?php
require ("db.php");

class Noni{
	private $con;
	function __construct(){
		
		global $con;
		$this->con = $con;
	}
	//get all post
	function get_all_post(){
		global $con;
		$query = "SELECT * FROM post LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid";
		$result = mysqli_query($con, $query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['post_title']= $row['title'];
				$arr['post_text']= $row['text'];
				$arr['pid']= $row['pid'];
				$arr['post_image']= $row['post_image'];
				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr2[]=$arr;
			}
			
			return $arr2;
		}

	}
	//get post by post id
	function get_post($pid){
		global $con;
		$query = "SELECT user.username, user_post.pid,user.profile_img, user_post.uid, post.title, post.post_image, post.type, post.text  FROM post LEFT JOIN user_post ON user_post.pid = post.pid
									LEFT JOIN user ON user.uid = user_post.uid WHERE post.pid=".$pid;
		$result = mysqli_query($con, $query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){

				$arr['post_title']= $row['title'];
				$arr['pid']= $row['pid'];
				$arr['post_image']= $row['post_image'];
				$arr['text']= $row['text'];
				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['uid'] = $row['uid'];
				$arr['profile_img']= $row['profile_img'];
				
			}
			
			return $arr;
		}

	}
	//get comments by post id
	function get_comments($pid){
		global $con;
		$query = "SELECT * FROM post LEFT JOIN comments_posts ON comments_posts.pid = post.pid
										LEFT JOIN user ON user.uid = comments_posts.uid
										LEFT JOIN comments ON comments.cid = comments_posts.cid WHERE post.pid=".$pid;
		$result = mysqli_query($con, $query);

		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['cid']= $row['cid'];
				$arr['uid']= $row['uid'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr['comment']= $row['comment'];
				
				$arr2[]=$arr;
			}
			
			return $arr2;
		}

	}
function create_post($uid, $title, $text, $url, $type){
		global $con;
		$query = "INSERT INTO post(title, text, post_image, type) VALUES ('".$title."','".$text."','".$url."','".$type."')";
		$result = mysqli_query($con, $query);
		if($result){
			//get last insert id and insert into user_post
			$id = mysqli_insert_id($con);
			$query = "INSERT INTO user_post(uid,pid) VALUES ('".$uid."','".$id."')";
			$result2 = mysqli_query($con,$query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}

	function create_comment($uid, $pid, $comment){
		global $con;
	 	$query = "INSERT INTO comments(comment) VALUES ('".$comment."')";
		$result = mysqli_query($con,$query);
		if($result){
			$id = mysqli_insert_id($con);
			$query = "INSERT INTO comments_posts(pid,uid,cid) VALUES('".$pid."','".$uid."','".$id."')";
			$result2 = mysqli_query($con, $query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}
	function edit_post($pid,$uid){
		global $con;

		$query = "UPDATE post "

	}
}
/*
$db = new Noni();
$asd="Gordon";
$a="1234";
$db->login_user($asd, $a);
*/


	


?>