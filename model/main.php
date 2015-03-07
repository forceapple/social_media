<?php
require ("db.php");

class Noni{
	private $con;
	function __construct(){
		
		global $con;
		$this->con = $con;
	}
	function get_all_post(){
		global $con;
		$query = "SELECT * FROM post LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid";
		$result = mysqli_query($con, $query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['post_title']= $row['title'];
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

}

$db = new Noni();
$asd="1";
print_r($db->get_post($asd));

?>