<?php
require ("db.php");

/*$query = "SELECT * FROM post LEFT JOIN comments_posts ON comments_posts.pid = post.pid
										LEFT JOIN user ON user.uid = comments_posts.uid";*/
class Noni{
	private $con;
	function __construct(){
		
		global $con;
		$this->con = $con;
	}
	function get_all_post(){
		global $con;
		//print_r("asd");
		$query = "SELECT * FROM post LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid";
		$result = mysqli_query($con, $query);
		
		//print_r($result);
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
		//print_r("asd");
		$query = "SELECT * FROM post LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid WHERE user.uid=".$pid;
		$result = mysqli_query($con, $query);
		
		//print_r($result);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){

				$arr['post_title']= $row['title'];
				$arr['pid']= $row['pid'];
				$arr['post_image']= $row['post_image'];
				$arr['text']= $row['text'];
				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr2[]=$arr;
			}
			
			return $arr2;
		}

	}

	function get_comments($pid){
		global $con;
		//print_r("asd");
		$query = "SELECT * FROM post LEFT JOIN comments_posts ON comments_posts.pid = post.pid
										LEFT JOIN user ON user.uid = comments_posts.uid
										LEFT JOIN comments ON comments.cid = comments_posts.cid WHERE post.pid=".$pid;
		$result = mysqli_query($con, $query);
		
		//print_r($result);
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